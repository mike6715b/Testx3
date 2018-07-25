<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
      'user_name', 'user_uid',
    ];

    protected $hidden = [
        'user_pwd', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->user_pwd;
    }
}
