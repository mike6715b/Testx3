<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request) {
        Auth::attempt([
            'user_uid' => $request->username,
            'user_pwd' => $request->password,
        ]);

        if (Auth::check()) {
            return view('mainmenu');
        } else {
            return view('login');
        }
    }

    public function logout() {
        Auth::logout();
        return view('login');
    }

}
