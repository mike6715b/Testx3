<?php

namespace App\Http\Controllers;

use App\SubjPerm;
use App\User;
use App\Field;
use App\Subject;
use App\Classes;
use App\Question;
use App\ClassPerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserTransactionController extends Controller
{

    public function classadd(Request $request) {
        $name = $request->name;

        $classes = new Classes;
        $classes->class_name = $name;
        $classes->save();

        $classPerm = new ClassPerm;
        $classPerm->user_id = $request->user;
        $classPerm->class_id = $classes->id;
        $classPerm->main_teacher = 1;
        $classPerm->list_student = 1;
        $classPerm->add_student = 1;
        $classPerm->remove_student = 1;
        $classPerm->edit_student = 1;
        $classPerm->read_student_info = 1;
        $classPerm->assign_exam = 1;
        $classPerm->list_grade = 1;
        $classPerm->save();

        info('New class added!', ['id' => $classes->id, 'name' => $name,]);

        if (isset($request->multi)) {
            $mul = true;
            return redirect()->route('mainmenu.classadd')->with($mul);
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function studadd(Request $request) {
        $name = $request->name;
        $uid = $request->uid;
        $email = $request->email;
        $pwd = $request->pwd;
        $class = $request->class;

        if ($pwd == null) {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $pwd = implode($pass); //turn the array into a string

        }

        $user = new User;
        $user->user_name = $name;
        $user->user_uid = $uid;
        $user->user_email = $email;
        $user->user_pwd = \Illuminate\Support\Facades\Hash::make($pwd);
        $user->user_class = $class;
        $user->save();

        if (isset($request->multi)) {
            return redirect()->route('mainmenu.studadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function teachadd(Request $request)
    {
        if (Auth::user()->user_class != 'admin') {
            return back();
        }
        $name = $request->name;
        $uid = $request->uid;
        $email = $request->email;
        $pwd = $request->pwd;

        $user = new User;
        $user->user_name = $name;
        $user->user_uid = $uid;
        $user->user_email = $email;
        $user->user_pwd =  \Illuminate\Support\Facades\Hash::make($pwd);
        $user->user_class = 'teacher';
        $user->save();

        if (isset($request->multi)) {
            return redirect()->route('mainmenu.teachadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function subjadd(Request $request) {
        $subject = new Subject;
        $subject->subj_name = $request->name;
        $subject->subj_author = $request->teacher;
        $subject->save();
        $subjectPerm = new SubjPerm;
        $subjectPerm->user_id = $request->teacher;
        $subjectPerm->subj_id = $subject->id;
        $subjectPerm->list_subj = 1;
        $subjectPerm->add_field = 1;
        $subjectPerm->add_question = 1;
        $subjectPerm->make_exam = 1;
        $subjectPerm->save();

        if (isset($request->gradiva)) {
            return redirect()->route('mainmenu.fieldadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function fieldadd(Request $request) {
        $name = $request->name;
        $subj = $request->subject;

        $field = new Field;
        $field->field_name = $name;
        $field->field_subj_id = $subj;
        $field->save();

        return redirect()->route('mainmenu');
    }

    public function fieldquesadd(Request $request) {
        $subject = $request->subjectSel;
        $field = $request->fieldSel;
        $quesType = $request->quesType;
        $quest = $request->question;
        $answer = $request->ans;
        $corrAns = $request->tocanOdg;
        $multi = $request->multi;

        $param = [
            0 => $quest,
            1 => $answer,
            2 => $corrAns,
            3 => $quesType,
        ];

        $quesInTable = Question::where('ques_subj_id', '=', $subject)->where('ques_field_id', '=', $field)->get();
        if (count($quesInTable) == 0) {
            $question = $this->newQuestion($param);
            $this->saveQuestion($subject, $field, $question);
        } else {
            $quesInTableID = Question::where('ques_subj_id', '=', $subject)->where('ques_field_id', '=', $field)->pluck('ques_id');
            $quesCurrDecoded = json_decode($quesInTable[0]->ques_questions, TRUE);
            $question = $this->addQuestion($param, count($quesCurrDecoded), $quesCurrDecoded);
            $this->saveQuestion($subject, $field, $question, $quesInTableID[0]);
        }

        if ($multi == 1) {
            return view('usertransactions.fieldquesadd')->with('retData', [$subject, $field]);
            //return redirect()->route('mainmenu.fieldquesadd')->with('retData', [$subject, $field]);
        } else {
            return redirect()->route('mainmenu');
        }
    }

    protected function addQuestion($param, $numer, $currentQuestion) {
        if ($param[3] == 1 || $param[3] == 2 || $param[3] == 3) {
            $num = $numer+1;
                $question = [
                    'question' => $param[0],
                    'type' => $param[3],
                    'ans' => $param[1],
                    'correct' => $param[2]
                ];

            $currentQuestion[$num] = $question;

            $question = json_encode($currentQuestion);
            return $question;
        } else {
            return -1;
        }
    }

    protected function newQuestion($param) {
        $question = $param[0];
        $ans = $param[1];
        $corrAns = $param[2];

        if ($param[3] == 1 || $param[3] == 2 || $param[3] == 3) {
            $quest = [
                1 => [
                    'question' => $question,
                    'type' => $param[3],
                    'ans' => $ans,
                    'correct' => $corrAns,
                ]
            ];
            $quest = json_encode($quest);
            return $quest;
        } else {
            return -1;
        }
    }

    protected function saveQuestion($subject, $field, $question, $id=0) {
        $questions = new Question;
        if ($id != 0) {
            $questions->destroy($id);
            $questions->ques_id = $id;
        }
        $questions->ques_subj_id = $subject;
        $questions->ques_field_id = $field;
        $questions->ques_questions = $question;
        $questions->save();
    }

    public function ajaxGetFields(Request $request) {
        $subj = $request->subj;
        $res = DB::table('fields')->where('field_subj_id', $subj)->pluck('field_id', 'field_name');
        return json_encode($res);
    }

    public function ajaxGetTestCount(Request $request) {
        $field = $request->field;
        $return = Question::where('ques_field_id', $field)->first();
        if ($return == null) {
            echo 1;
            exit;
        }
        $return = json_decode($return->ques_questions, true);
        echo count($return)+1;
    }

    public function ajaxGetStudents(Request $request) {
        $classes = User::getClassesForUserList();
        if (!$classes->contains($request->class)) {
            dd("Nedovoljna dopustenja!");
        }
        $users = User::where('user_class', $request->class)->get();
        $students = collect();
        foreach ($users as $key => $user) {
            $student = collect([
                $key => [
                    'user_name' => $user->user_name,
                    'user_email' => $user->user_email,
                    'user_uid' => $user->user_uid,
                    'user_class' => Classes::where('class_id', $user->user_class)->value('class_name')
                ]
            ]);
            $students->put($key, $student[$key]);
        }
        return json_encode($students);
    }

    public function ajaxUpdateClassPerm(Request $request) {
        User::updateClassPerm($request->user_id, $request->class_id, $request->perm, $request->value);
    }

}
