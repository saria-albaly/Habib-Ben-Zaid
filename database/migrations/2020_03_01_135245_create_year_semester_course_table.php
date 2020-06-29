<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearSemesterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_semester_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('session_number');
            $table->date('startdate');
            $table->date('enddate');
/*            $table->unsignedBigInteger('course_id');*/
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('semester_id');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        Schema::table('year_semester_course', function (Blueprint $table) {
/*            $table->foreign('course_id')
             ->references('id')
             ->on('courses')
             ->onDelete('cascade');*/

            $table->foreign('year_id')
             ->references('id')
             ->on('years')
             ->onDelete('cascade');

            $table->foreign('semester_id')
             ->references('id')
             ->on('semesters')
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
        Schema::dropIfExists('year_semester_course');
    }
}
