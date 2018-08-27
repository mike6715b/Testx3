<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
use App\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

        $user = new User;
        $user->user_name = $name;
        $user->user_uid = $uid;
        $user->user_email = $email;
        $user->user_pwd = \Illuminate\Support\Facades\Hash::make($pwd);
        $user->user_class = $class;
        $user->save();

        if (isset($request->multi)) {
            return redirect()->route('mainmenu.studadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function teachadd(Request $request)
    {
        $name = $request->name;
        $uid = $request->uid;
        $email = $request->email;
        $pwd = $request->pwd;

        $user = new User;
        $user->user_name = $name;
        $user->user_uid = $uid;
        $user->user_email = $email;
        $user->user_pwd =  \Illuminate\Support\Facades\Hash::make($pwd);
        $user->user_class = 'teacher';
        $user->save();

        if (isset($request->multi)) {
            return redirect()->route('mainmenu.teachadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

    public function subjadd(Request $request) {
        $name = $request->name;

        $subject = new Subject;
        $subject->subj_name = $name;
        $subject->subj_author = Auth::user()->user_uid;
        $subject->save();

        if (isset($request->gradiva)) {
            return redirect()->route('mainmenu.fieldadd');
        } else {
            return redirect()->route('mainmenu');
        }
    }

}
