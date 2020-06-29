<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('address');
            $table->string('phone');
            $table->string('talents');
            $table->string('student_image');
            $table->integer('brothers');
            $table->unsignedBigInteger('course_id');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('course_id')
             ->references('id')
             ->on('courses')
             ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
