<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ClassPerm;
use App\Field;
use App\Question;
use App\Subject;
use App\SubjPerm;
use App\Test;
use App\TestClass;
use App\TestDone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Array_;

class PagesController extends Controller
{

    protected function isUserAdmin() {
        if (Auth::user()->user_class == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    protected function isUserTeacher() {
        if (Auth::user()->user_class == 'teacher') {
            return true;
        } elseif (Auth::user()->user_class == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function mainmenu(Request $request) {
        $user_class = Auth::user()->user_class;
        return view('mainmenu')->with($user_class);
    }

    public function exam() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        $subjectsForUser = User::getSubjectsForUser();
        $activeExams = $this->getActiveExams($subjectsForUser);
        $inactiveExams = $this->getInactiveExams($subjectsForUser);
        //dump($inactiveExams);
        //dd($inactiveExams[0]->isEmpty());
        if ($activeExams != null || $activeExams[0]->isEmpty() != true) {
            $activeClasses = $this->getClasses($activeExams);
        } else {
            $activeClasses = null;
        }
        if ($inactiveExams != null || $inactiveExams[0]->isEmpty() != true) {
            $inactiveClasses = $this->getClasses($inactiveExams);
        } else {
            $inactiveClasses = null;
        }
        //dd($activeExams);
        dump('User can only use a field in 1 test!');
        return view('exam.manage')
            ->with('active', $activeExams[0])
            ->with('inactive', $inactiveExams[0])
            ->with('activeClasses', $activeClasses)
            ->with('inactiveClasses', $inactiveClasses);
    }

    protected function getInactiveExams($subjectsForUser) {
        if ($this->isUserAdmin()) {
            $inactiveExams = collect();
            $tests = Test::where('status', 0)->get();
            foreach ($tests as $test) {
                $inactiveExams->push($test);
            }
        } else {
            $inactiveExams = collect();
            foreach($subjectsForUser as $key => $subjectForUser) {
                $questions = Question::where('ques_subj_id', $subjectForUser['subj_id'])->get();
                foreach ($questions as $keyQ => $question) {
                    $inactiveExams->push(Test::where('test_ques', $question->ques_id)->where('status', 0)->get());
                }
            }
        }
        return $inactiveExams;
    }

    protected function getActiveExams($subjectsForUser) {
        if ($this->isUserAdmin()) {
            $activeExams = collect();
            $activeExams->push(Test::where('status', 1)->get());
        } else {
            $activeExams = collect();
            foreach($subjectsForUser as $key => $subjectForUser) {
                $questions = Question::where('ques_subj_id', $subjectForUser['subj_id'])->get();
                foreach ($questions as $keyQ => $question) {
                    $activeExams->push(Test::where('test_ques', $question->ques_id)->where('status', 1)->get());
                }
            }
        }
        return $activeExams;
    }

    protected function getClasses($tests) {
        $return = array();
        foreach ($tests as $key => $test) {
            if ($test->isEmpty()) {
                continue;
            }
            $classes = array();
            $ClassesForTest = TestClass::where('test_id', $test[0]->test_id)->get();
            foreach ($ClassesForTest as $class) {
                $classData = Classes::where('class_id', $class->class_id)->first();
                array_push($classes, $classData->class_name);
            }
            array_push($return, $classes);
        }
        return $return;
    }

    public function examlist() {
        if ($this->isUserAdmin() || $this->isUserTeacher()) {
            $self = Test::where('test_type', '2')->where('status', 1)->get();
            $exam = Test::where('test_type', '1')->where('status', 1)->get();
            return view('exam.examlist')->with('self', $self)->with('exam', $exam);
        }

        $exam = $this->getTests(1);
        $self = $this->getTests(2);

        return view('exam.examlist')->with('self', $self)->with('exam', $exam);
    }

    protected function getTests($test_type) {
        $return = array();
        $tests = Test::where('test_type', '=', $test_type)->where('status', '=', 1)->get();
        if  (empty($tests)) {
            return null;
        }
        foreach ($tests as $TestKey => $test) {
            if ($test->test_type == 1 && !empty(TestDone::where('test_id', $test->test_id)->first())) {
                continue;
            }
            $testClasses = TestClass::where('test_id', $test->test_id)->get();
            foreach ($testClasses as $Classkey => $classes) {
                if ($classes->class_id == Auth::user()->user_class) {
                    array_push($return, $test);
                }
            }
        }
        return $return;
    }

    public function examresult() {
        $data = TestDone::where('test_user_id', '=', Auth::user()->user_id)->get();
        return view('exam.results')
            ->with('data', $data);
    }

    public function studadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.studadd');
    }

    public function classadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.classadd');
    }

    public function classlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->rotue('mainmenu');
        }
        $classes = User::getClassesWithPerm('list_class');
        return view('usertransactions.classlist')->with('classes', $classes);
    }

    public function manageclass(Request $request) {
        $perms = User::getPermsForClass($request->class_id);
        return view('usertransactions.manageclass')->with('perms', $perms);
    }

    public function studlist(Request $request) {
        if (!$this->isUserTeacher()) {
            return redirect()->route('mainmenu');
        }
        $students = User::where('user_class', $request->class_id)->get();
        return view('usertransactions.studlist')->with('students', $students);
    }

    public function teachadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.teachadd');
    }

    public function teachlist() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.teachlist');
    }

    public function subjadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.subjadd');
    }

    public function subjlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.subjlist');
    }

    public function fieldadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        $subjects = User::getSubjectWithPerm('add_field');
        return view('usertransactions.fieldadd')->with('subjects', $subjects);
    }

    public function fieldquesadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        $subjects = User::getSubjectWithPerm('add_question');
        return view('usertransactions.fieldquesadd')->with('subjects', $subjects);
    }

    public function fieldlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        $subjects = User::getSubjectWithPerm('list_subj');
        return view('usertransactions.fieldlist')->with('subjects', $subjects);
    }

    public function listquestion(Request $request) {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        if(!array_key_exists($request->id, User::getSubjectWithPerm('list_subj'))) {
            return redirect()->route('mainmenu');
        }
        $res = Question::where('ques_field_id', $request->id)->first();
        $decoded = json_decode($res->ques_questions, TRUE);
        return view('usertransactions.listquestion')->with('decoded', $decoded);
    }
}
