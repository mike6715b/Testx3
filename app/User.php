<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
      'user_name', 'user_uid', 'user_email', 'user_class'
    ];

    protected $hidden = [
        'user_pwd', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->user_pwd;
    }
}
