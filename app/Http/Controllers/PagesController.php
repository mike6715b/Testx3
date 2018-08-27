<?php

namespace App\Http\Controllers;

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

    }

    public function teachlist() {

    }

    public function subjadd() {

    }

    public function subjlist() {

    }

    public function fieldadd() {

    }

    public function fieldquesadd() {

    }

    public function fieldlist() {

    }
}
