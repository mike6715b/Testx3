<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $table = 'tests';
    public $primaryKey = 'test_id';
    public $timestamps = false;
}
