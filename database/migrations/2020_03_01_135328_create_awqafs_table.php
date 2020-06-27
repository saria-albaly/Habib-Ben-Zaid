<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwqafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awqafs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notes');
            $table->integer('juza');
            $table->integer('point_amount');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
        });


/*        Schema::table('awqafs', function (Blueprint $table) {
            $table->foreign('student_id')
             ->references('id')
             ->on('students')
             ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('awqafs');
    }
}
