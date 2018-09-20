<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    public $table = 'class_subject';
    public $primaryKey = 'class_subj_id';
    public $timestamps = false;
}
