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

        //Auth::loginUsingId('1');

        if (Auth::check()) {
            info('User sucessfully logged in!', ['uid' => Auth::user()]);
            return redirect()->route('mainmenu');
        } else {
            $errors = "Incorrect login data!";
            info('User loggin attempt failed!', ['uid' => Auth::user()]);
            return view('login')->with($errors);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
