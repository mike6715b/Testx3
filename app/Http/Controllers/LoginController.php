<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        Auth::attempt(array(
            'user_uid' => $request->username,
            'password' => $request->password,
        ));

        if (Auth::check()) {
            return view('mainmenu');
        } else {
            return back();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
