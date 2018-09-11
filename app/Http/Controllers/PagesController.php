<?php

namespace App\Http\Controllers;

use App\Field;
use App\Question;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function mainmenu(Request $request) {
        //dd(Auth::user());
        $user_class = Auth::user()->user_class;
        return view('mainmenu')->with($user_class);
    }

    public function exam() {
        return view('usertransactions.exam');
    }

    public function contrlexam() {
        return 'controlexam';
    }

    public function selfcheck() {
        return 'selfcheck';
    }

    public function studadd() {
        return view('usertransactions.studadd');
    }

    public function classadd() {
        return view('usertransactions.classadd');
    }

    public function studlist() {
        return view('usertransactions.studlist');
    }

    public function teachadd() {
        return view('usertransactions.teachadd');
    }

    public function teachlist() {
        return view('usertransactions.teachlist');
    }

    public function subjadd() {
        return view('usertransactions.subjadd');
    }

    public function subjlist() {
        return view('usertransactions.subjlist');
    }

    public function showques(Request $request) {
        $res = Question::where('ques_field_id', $request->id)->first();
        $decoded = json_decode($res->ques_questions, TRUE);
        return view('usertransactions.showques')->with('decoded', $decoded);
    }

    public function fieldadd() {
        return view('usertransactions.fieldadd');
    }

    public function fieldquesadd() {
        return view('usertransactions.fieldquesadd');
    }

    public function fieldlist() {
        return view('usertransactions.fieldlist');
    }
}
