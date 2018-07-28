<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTransactionController extends Controller
{
    /**
     * @param $user_class
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function CheckUserClass($user_class, Request $request) {
        if (Session::get('user_class') != $user_class) {
            return redirect()->route('mainmenu');
        }
    }


}
