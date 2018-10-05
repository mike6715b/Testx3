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
        $testID = $request->id;
        $test = Test::where('test_id', '=', $testID)->first();
        $questionRow = Question::where('ques_id', '=', $test->test_ques)->first();
        $questions = json_decode($questionRow->ques_questions, TRUE);
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
        $counter = 0;
        foreach ($questions_rand as $ques_rando) {
            $anss = [
                $ques_rando['ans1'],
                $ques_rando['ans2'],
                $ques_rando['ans3'],
                $ques_rando['ans4']
            ];
            $anses = [];
            for ($i = 0; $i < count($anss); $i++) {
                if (!$anss[$i] == null) {
                    do {
                        $num = rand(1, count($anss));
                    } while (in_array($num, $anses));
                    $anses[$i] = $num;
                }
            }
            $questions_rand[$counter]['ans1'] = $anss[$anses[0]-1];
            $questions_rand[$counter]['ans2'] = $anss[$anses[1]-1];
            $questions_rand[$counter]['ans3'] = $anss[$anses[2]-1];
            $questions_rand[$counter]['ans4'] = $anss[$anses[3]-1];
            $request->session()->put($counter, $questions_rand[$counter]['correct']);
            $counter++;
        }
        $request->session()->put('test_type', $test->test_type);
        return view('exam.examgen')->with('questions', $questions_rand);
    }

    public function examcheck(Request $request) {
        dd($request);
    }
}
