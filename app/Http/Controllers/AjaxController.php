<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use Illuminate\Http\Request;
use App\ClassPerm;
use App\SubjPerm;
use App\Field;
use App\User;


class AjaxController extends Controller
{
    public function ajaxGetFields(Request $request) {
        $subj = $request->subj;
        $res = Field::where('field_subj_id', $subj)->pluck('field_id', 'field_name');
        return json_encode($res);
    }

    public function ajaxGetFieldsForExam(Request $request) {
        $subj = $request->subj;
        $query = Field::where('field_subj_id', $subj)->pluck('field_id', 'field_name');
        $res = array();
        foreach ($query as $key => $field) {
            $ques_id = Question::where('ques_field_id', $field)->pluck('ques_id');
            if (!Test::where('test_ques', $ques_id)->first()) {
                $res = [
                    $key => $field
                ];
            }
        }
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

    public function ajaxGetTeachers(Request $request) {
        $res = User::where('user_class', 'teacher')->pluck('user_id', 'user_name');
        return json_encode($res);
    }

    public function ajaxAddClassPerm(Request $request) {
        $classPerm = new ClassPerm();
        $classPerm->user_id = $request->teach_id;
        $classPerm->class_id = $request->class_id;
        $classPerm->main_teacher = 0;
        $classPerm->list_class = 0;
        $classPerm->list_student = 0;
        $classPerm->add_student = 0;
        $classPerm->remove_student = 0;
        $classPerm->edit_student = 0;
        $classPerm->read_student_info = 0;
        $classPerm->assign_exam = 0;
        $classPerm->list_grade = 0;
        $classPerm->save();
    }

    public function ajaxUpdateClassPerm(Request $request) {
        User::updateClassPerm($request->user_id, $request->class_id, $request->perm, $request->value);
    }

    public function ajaxDeleteClassPerm(Request $request) {
        ClassPerm::where('user_id', $request->user_id)->where('class_id', $request->class_id)->delete();
    }

    public function ajaxUpdateSubjectPerm(Request $request) {
        User::updateSubjPerm($request->user_id, $request->subj_id, $request->perm, $request->value);
    }

    public function ajaxDeleteSubjectPerm(Request $request) {
        SubjPerm::where('user_id', $request->user_id)->where('subj_id', $request->subj_id)->delete();
    }

    public function ajaxAddSubjectPerm(Request $request) {
        $subjPerm = new SubjPerm();
        $subjPerm->user_id = $request->teach_id;
        $subjPerm->subj_id = $request->subj_id;
        $subjPerm->subj_author = 0;
        $subjPerm->list_subj = 0;
        $subjPerm->add_field = 0;
        $subjPerm->remove_field = 0;
        $subjPerm->add_question = 0;
        $subjPerm->remove_question = 0;
        $subjPerm->make_exam = 0;
        $subjPerm->save();
    }
}
