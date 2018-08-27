<?php

namespace App\Http\Controllers;

use App\User;
use App\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class UserTransactionController extends Controller
{

    public function classadd(Request $request) {
        $name = $request->name;

        $classes = new Classes;
        $classes->class_name = $name;
        $classes->save();

        if (isset($request->multi)) {
            $mul = true;
            return redirect()->route('mainmenu.classadd')->with($mul);
        } else {
            return $classes->all();
        }
    }

    public function studadd(Request $request) {
        $name = $request->name;
        $uid = $request->uid;
        $email = $request->email;
        $pwd = $request->pwd;
        $class = $request->class;
        return $class;
        $user = new User;
        //
    }

}
