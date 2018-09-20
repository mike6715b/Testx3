<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Test;

class ExamController extends Controller
{
    public function examcreate(Request $request) {
        $title = $request->title;
        $class = json_encode($request->class);
        $subject = $request->subject;
        $field = $request->field;
        $type = $request->type;

        $question = Question::where('ques_subj_id', '=', $subject)->where('ques_field_id', '=', $field)->pluck('ques_id');

        $exam = new Test;
        $exam->test_title = $title;
        $exam->test_class = $class;
        $exam->test_ques = $question[0];
        $exam->test_type = $type;
        $exam->status = 1;
        $exam->save();

        return redirect()->route('mainmenu.exam');
    }
}
