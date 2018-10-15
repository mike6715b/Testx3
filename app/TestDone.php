<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestDone extends Model
{
    public $table = 'testsdone';
    public $primaryKey = 'testdone_id';
    public $timestamps = false;
}
