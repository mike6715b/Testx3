<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassPermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_perms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('class_id');
            $table->boolean('list_class');
            $table->boolean('list_student');
            $table->boolean('add_student');
            $table->boolean('remove_student');
            $table->boolean('edit_student');
            $table->boolean('read_student_info');
            $table->boolean('assign_exam');
            $table->boolean('list_grade');
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
        Schema::dropIfExists('class_perms');
    }
}
