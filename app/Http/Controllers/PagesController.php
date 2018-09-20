<?php

namespace App\Http\Controllers;

use App\Field;
use App\Question;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    protected $user_class;

    protected function isUserAdmin() {
        if (Auth::user()->user_class == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    protected function isUserTeacher() {
        if (Auth::user()->user_class == 'teacher') {
            return true;
        } elseif (Auth::user()->user_class == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function mainmenu(Request $request) {
        //dd(Auth::user());
        $user_class = Auth::user()->user_class;
        return view('mainmenu')->with($user_class);
    }

    public function exam() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('exam.manage');
    }

    public function examlist() {
        return view('exam.examlist');
    }

    public function examresult() {
        return 'examresult';
    }

    public function studadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.studadd');
    }

    public function classadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.classadd');
    }

    public function studlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.studlist');
    }

    public function teachadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.teachadd');
    }

    public function teachlist() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.teachlist');
    }

    public function subjadd() {
        if ($this->isUserAdmin() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.subjadd');
    }

    public function subjlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.subjlist');
    }

    public function showques(Request $request) {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        $res = Question::where('ques_field_id', $request->id)->first();
        $decoded = json_decode($res->ques_questions, TRUE);
        return view('usertransactions.showques')->with('decoded', $decoded);
    }

    public function fieldadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.fieldadd');
    }

    public function fieldquesadd() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.fieldquesadd');
    }

    public function fieldlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->route('mainmenu');
        }
        return view('usertransactions.fieldlist');
    }
}
