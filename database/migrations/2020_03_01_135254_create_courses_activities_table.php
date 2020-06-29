<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('y_s_c_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();
        });

        Schema::table('course_activities', function (Blueprint $table) {
            $table->foreign('course_id')
             ->references('id')
             ->on('courses')
             ->onDelete('cascade');
             
            $table->foreign('activity_id')
             ->references('id')
             ->on('activities')
             ->onDelete('cascade');

            $table->foreign('y_s_c_id')
             ->references('id')
             ->on('year_semester_course')
             ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_activities');
    }
}
