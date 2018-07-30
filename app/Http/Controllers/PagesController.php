<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    /**
     * Provjerava dali je korisnik ispravne klase (admin, teacher, student)
     *
     * @param $user_class
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function checkLoginInPages($user_class, Request $request) {
        if (Session::get('user_class') != $user_class) {
            return redirect()->route('mainmenu');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainmenu(Request $request) {
        dd($request->session()->all());
        return view('mainmenu');
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
        return 'studadd';
    }

    public function classadd() {

    }

    public function studlist() {

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
