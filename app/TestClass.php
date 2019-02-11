<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestClass extends Model
{
    public $table = 'test_class';
    public $primaryKey = 'test_class_id';
    public $timestamps = false;
}
