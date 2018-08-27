<?php

namespace App\Http\Controllers;

use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    public function __construct()
    {
        return 'hy';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainmenu(Request $request) {
        //dd(Auth::user());
        $user_class = Auth::user()->user_class;
        return view('mainmenu')->with($user_class);
    }

    public function exam() {
        return 'exam';
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
        $users = User::where('user_class', '!=', 'teacher')->where('user_class', '!=', 'admin')->get();
        return view('usertransactions.studlist')->with($users);
    }

    public function teachadd() {
        return view('usertransactions.teachadd');
    }

    public function teachlist() {
        $teachers = User::where('user_class', '=', 'teacher')->get();
        return view('usertransactions.teachlist')->with($teachers);
    }

    public function subjadd() {
        return view('usertransactions.subjadd');
    }

    public function subjlist() {
        $subjects = Subject::all();
        return view('usertransactions.subjlist')->with($subjects);
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
