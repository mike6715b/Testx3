<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*public function login(Request $request) {
        Auth::attempt(array(
            'user_uid' => $request->username,
            'password' => $request->password,
        ));

        if (Auth::check()) {
            return redirect()->route('mainmenu');
        } else {
            return back();
        }
    }*/

    public function login(Request $request) {
        session([
            'user_id' => '1',
            'user_name' => 'Bruno Rehak',
            'user_uid' => 'bruno.rehak',
            'user_email' => 'bruno.rehak@gmail.com',
            'user_class' => 'admin',
        ]);
        return redirect()->route('mainmenu');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
