<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('point_cause');
            $table->integer('point_amount');
            $table->unsignedBigInteger('y_s_c_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();
        });

        Schema::table('student_points', function (Blueprint $table) {          
            $table->foreign('y_s_c_id')
             ->references('id')
             ->on('year_semester_course')
             ->onDelete('cascade');

            $table->foreign('course_id')
             ->references('id')
             ->on('courses')
             ->onDelete('cascade'); 
/*             $table->foreign('student_id')
             ->references('id')
             ->on('students')
             ->onDelete('cascade')
             ->onUpdate('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_points');
    }
}
