<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Field;
use App\Question;
use App\Subject;
use App\Test;
use App\TestClass;
use App\TestDone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

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
        $active = Test::where('status', '=', '1')->get();
        $activeClasses = $this->getClasses($active);
        $inactive = Test::where('status', '!=', '1')->get();
        $inactiveClasses = $this->getClasses($inactive);
        return view('exam.manage')
            ->with('active', $active)
            ->with('inactive', $inactive)
            ->with('activeClasses', $activeClasses)
            ->with('inactiveClasses', $inactiveClasses);
    }

    protected function getClasses($tests) {
        $return = array();
        foreach ($tests as $key => $test) {
            $classes = array();
            $ClassesForTest = TestClass::where('test_id', '=', $test->test_id)->get();
            foreach ($ClassesForTest as $class) {
                $classData = Classes::where('class_id', $class->class_id)->get();
                array_push($classes, $classData[0]->class_name);
            }

            $return = [
                $key => $classes
            ];
        }
        return $return;
    }

    public function examlist() {
        $self = $this->getSelfTest();
        $exam = $this->getExamTest();

        return view('exam.examlist')->with('self', $self)->with('exam', $exam);
    }

    protected function getExamTest() {
        $skips = ["[","]","\""];
        $tests = Test::where('test_type', '=', '1')->where('status', '=', 1)->get();
        if (count($tests) != 0) {
            $i = 1;
            $res = [];
            do {
                //Check
                $resul = TestDone::where('test_user_id', '=', Auth::user()->user_id)
                    ->where('test_id', '=', $tests[$i-1]->test_id)->get();
                if (count($resul) != 0) {
                    $i++;
                    continue;
                }

                $subj = \App\Subject::where('subj_id', '=', \App\Question::where('ques_id', '=', $tests[$i-1]->test_ques)->pluck('ques_subj_id'))->pluck('subj_name');
                $subj = str_replace($skips, ' ', $subj);
                $array = [
                    "1" => $tests[$i-1]->test_title,
                    "2" => $subj,
                    "3" => $tests[$i-1]->updated_at,
                    "4" => $tests[$i-1]->test_id,
                ];
                array_push($res, $array);
                $i++;
            } while (count($tests) > 1 && $i-1 < count($tests));
            return $res;
        } else {
            return null;
        }
    }

    protected function getSelfTest() {
        $skips = ["[","]","\""];
        $tests = Test::where('test_type', '=', '2')->where('status', '=', 1)->get();
        if (count($tests) != 0) {
            $i = 1;
            $res = [];
            do {
                $subj = \App\Subject::where('subj_id', '=', \App\Question::where('ques_id', '=', $tests[$i-1]->test_ques)->pluck('ques_subj_id'))->pluck('subj_name');
                $subj = str_replace($skips, ' ', $subj);
                $array = [
                    "1" => $tests[$i-1]->test_title,
                    "2" => $subj,
                    "3" => $tests[$i-1]->updated_at,
                    "4" => $tests[$i-1]->test_id,
                ];
                array_push($res, $array);
                $i++;
            } while (count($tests) > 1 && $i-1 < count($tests));
            return $res;
        } else {
            return null;
        }
    }

    public function examresult() {
        $data = TestDone::where('test_user_id', '=', Auth::user()->user_id)->get();
        return view('exam.results')
            ->with('data', $data);
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

    public function classlist() {
        if ($this->isUserTeacher() != true) {
            return redirect()->rotue('mainmenu');
        }
        return view('usertransactions.classlist');
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
        if ($this->isUserTeacher() != true) {
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
