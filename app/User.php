<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\ClassPerm;
use App\SubjPerm;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
      'user_name', 'user_uid', 'user_email', 'user_class'
    ];

    protected $hidden = [
        'user_pwd', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->user_pwd;
    }

    public function userClass()  {
        return $this->user_class;
    }

    /**
     * Check if user is 'admin', if true return true
     *
     * @return bool
     */
    public function isUserAdmin() {
        if (Auth::user()->user_class == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if user is 'teacher', if true return true
     *
     * @return bool
     */
    public function isUserTeacher() {
        if (Auth::user()->user_class == 'teacher') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if user is 'student', if true return true
     *
     * @return bool
     */
    public function isUserStudent() {
        if (Auth::user()->user_class != 'admin' && Auth::user()->user_class != 'teacher') {
            return true;
        } else {
            return false;
        }
    }

    public function scopegetClassesForUser() {
        $classesQuery = ClassPerm::where('user_id', Auth::id())->get();
        $class = collect();
        foreach ($classesQuery as $key => $classV) {
            if ($classV->list_student) {
                $class->push($classesQuery[$key]->class_id);
            }
        }
        return $class;
    }

    public function scopecanClasses($action) {
        $classQUery = ClassPerm::where('user_id', Auth::id())->first()->value($action);
        return $classQUery;
    }

    public function scopegetStudentsForClass($classID) {
        if (ClassPerm::where('user_id', Auth::id())->where('class_id', $classID)->value('list_student')) {
            dd('Success!');
        }
    }

    public static function getSubjectsForUser() {
        $query = SubjPerm::where('user_id', Auth::id())->get();
        $subset = $query->map(function ($user) {
            return $user->only(['subj_id', 'list_subj', 'add_field', 'add_question', 'make_exam']);
        });
        return $subset;
    }

    public static function getSubjectWithPerm($perm) {
        $subjectsForUser = static::getSubjectsForUser();
        $subjects = [];
        foreach ($subjectsForUser as $subject) {
            if (!$subject[$perm]) {
                continue;
            }
            $subj = Subject::where('subj_id', $subject['subj_id'])->value('subj_name');
            $subjects = [
                $subject['subj_id'] => $subj,
            ];
        }
        return $subjects;
    }
}
