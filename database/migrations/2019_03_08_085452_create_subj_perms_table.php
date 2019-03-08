<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjPermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subj_perms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subj_id');
            $table->boolean('list_subj');
            $table->boolean('add_field');
            $table->boolean('add_question');
            $table->boolean('make_exam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subj_perms');
    }
}
