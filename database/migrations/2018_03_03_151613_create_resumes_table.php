<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('work_company')->nullable();
            $table->string('work_position')->nullable();
            $table->string('work_city')->nullable();
            $table->string('work_description')->nullable();
            $table->date('work_started')->nullable();
            $table->date('work_ended')->nullable();
            $table->string('university_school')->nullable();
            $table->date('university_started')->nullable();
            $table->date('university_ended')->nullable();
            $table->string('university_degree')->nullable();
            $table->string('university_description')->nullable();
            $table->string('highschool_school')->nullable();
            $table->date('highschool_started')->nullable();
            $table->date('highschool_ended')->nullable();
            $table->string('highschool_description')->nullable();
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
        Schema::dropIfExists('resumes');
    }
}
