<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $primaryKey = 'ques_id';
    public $timestamps = false;
}
