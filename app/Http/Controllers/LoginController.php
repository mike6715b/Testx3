<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dotenv\Validator;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request) {
        $this->validate($request);

        if ($this->findUserByName($request) == null) {
            return view('login');
        }
    }

    public function logout() {

    }

    protected function validate($request) {
        $validator = Validator::make($request->all(), [
           'username' => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return view('login');
        }

        return true;
    }

    protected function findUserByName($request) {

    }
}
