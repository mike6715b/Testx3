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

    public static function getClassesForUserList() {
        $classesQuery = ClassPerm::where('user_id', Auth::id())->get();
        $class = collect();
        foreach ($classesQuery as $key => $classV) {
            if ($classV->list_student) {
                $class->push($classesQuery[$key]->class_id);
            }
        }
        return $class;
    }

    public static function getClassesForUser() {
        $query = ClassPerm::where('user_id', Auth::id())->get();
        $subset = $query->map(function ($user) {
            return $user->only(['class_id', 'list_class', 'list_student', 'add_student', 'remove_student', 'edit_student',
                'read_student_info', 'assign_exam', 'list_grade']);
        });
        return $subset;
    }

    public static function getPermsForClass($class) {
        $query = ClassPerm::where('class_id', $class)->get();
        $subset = $query->map(function ($user) {
            return $user->only(['user_id', 'class_id', 'list_class', 'list_student', 'add_student', 'remove_student', 'edit_student',
                'read_student_info', 'assign_exam', 'list_grade']);
        });
        return $subset;
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

    public static function getClassesWithPerm($perm) {
        $classesForUser = static::getClassesForUser();
        $classes = [];
        foreach ($classesForUser as $class) {
            if (!$class[$perm]) {
                continue;
            }
            $cla = Classes::where('class_id', $class['class_id'])->value('class_name');
            $classes[$class['class_id']] = $cla;
        }
        return $classes;
    }

    public static function canUserClass($class, $perm) {
        $classPerms = ClassPerm::where('user_id', Auth::id())->where('class_id', $class)->first();
        if ($classPerms[$perm]) {
            return true;
        } else {
            return false;
        }

    }

    public static function isTeacherMainClass($class) {
        $classPerms = ClassPerm::where('user_id', Auth::id())->where('class_id', $class)->where('main_teacher', true)->first();
        if ($classPerms) {
            return true;
        } else {
            return false;
        }
    }

    public static function isTeacherMainSubject($subj_id) {
        $subjPerms = SubjPerm::where('user_id', Auth::id())->where('subj_id', $subj_id)->where('subj_author', true)->first();
        if ($subjPerms) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSubjectsForUser() {
        $query = SubjPerm::where('user_id', Auth::id())->get();
        $subset = $query->map(function ($user) {
            return $user->only(['subj_id', 'list_subj', 'add_field', 'remove_field', 'add_question', 'remove_field', 'make_exam']);
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
            $subjects[$subject['subj_id']] = $subj;
        }
        return $subjects;
    }

    public static function updateClassPerm($userID, $classID, $perm, $value) {
        if ($value == "true") {
            ClassPerm::where('user_id', $userID)
                ->where("class_id", $classID)
                ->update([$perm => 1]);
        } else {
            ClassPerm::where('user_id', $userID)
                ->where("class_id", $classID)
                ->update([$perm => 0]);
        }
    }

    public static function getPermsForSubject($subj_id) {
        $query = SubjPerm::where('subj_id', $subj_id)->get();
        $subset = $query->map(function ($user) {
            return $user->only(['user_id', 'subj_id', 'subj_author', 'list_subj', 'list_subj', 'add_field', 'remove_field',
                'add_question', 'remove_question', 'make_exam']);
        });
        return $subset;
    }

    public static function updateSubjPerm($userID, $subjID, $perm, $value) {
        if ($value == "true") {
            SubjPerm::where('user_id', $userID)
                ->where("subj_id", $subjID)
                ->update([$perm => 1]);
        } else {
            SubjPerm::where('user_id', $userID)
                ->where("subj_id", $subjID)
                ->update([$perm => 0]);
        }
    }
}
