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

    public function examgen(Request $request) {
        $test = Test::where('test_id', '=', $request->id)->first();
        $questionRow = Question::where('ques_id', '=', $test->test_ques)->first();
        $questions = json_decode($questionRow->ques_questions, TRUE);
        // RANDOMIZING QUESTIONS
        $ques_nums = [];
        for ($i = 0; $i < count($questions); $i++) {
            do {
                $num = rand(1, count($questions));
            } while (in_array($num, $ques_nums));
            $ques_nums[$i] = $num;
        }
        for ($i = 0; $i < count($questions); $i++) {
            $ques_num = $ques_nums[$i];
            $ques = $questions[$ques_num];
            $questions_rand[$i] = $ques;
        }
        for ($i = 0; $i < count($questions_rand); $i++) {
            $request->session()->put($i, $questions_rand[$i]['correct']);
        }
        $request->session()->put('test_type', $test->test_type);
        return view('exam.examgen')->with('questions', $questions_rand);
    }

    public function examcheck(Request $request) {
        $score = 0;
        $key = 0;
        do {
            $corrAns = $request->session()->get($key);
            $ans = $request->all();
            if (!key_exists($key, $ans['ans'])) {
                $key++;
                continue;
            }
            $ans = $ans['ans'][$key];
            if (count($corrAns) == count($ans)) {
                $contr = [];
                for ($i = 0; $i < count($corrAns); $i++) {
                    if (in_array($ans[$i], $corrAns)) {
                        array_push($contr, 1);
                    }
                }
                if (!in_array(0, $contr)) {
                    $score++;
                }
            }
            $key++;
        } while ($request->session()->has($key));
        dd($score);
    }
}
