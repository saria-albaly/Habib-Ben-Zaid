<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_name');
            $table->unsignedBigInteger('teacher_id');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('teacher_id')
             ->references('id')
             ->on('teachers')
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
        Schema::dropIfExists('courses');
    }
}
