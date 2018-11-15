<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

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
}
