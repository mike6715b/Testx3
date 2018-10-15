<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsdoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testsdone', function (Blueprint $table) {
            $table->increments('testdone_id');
            $table->integer('test_id');
            $table->integer('test_user_id');
            $table->integer('test_grade');
            $table->longText('test_anses');
            $table->char('test_complete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testsdone', function (Blueprint $table) {
            //
        });
    }
}
