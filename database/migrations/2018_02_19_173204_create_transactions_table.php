<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seeker_id')->unsigned();
            $table->foreign('seeker_id')->references('id')->on('users');
            $table->integer('bidder_id')->unsigned();
            $table->foreign('bidder_id')->references('id')->on('users');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('payment_id')->nullabe();
            $table->decimal('amount', 11,2)->nullable();
            $table->decimal('commission',11,2)->nullable();
            $table->decimal('total', 11,2)->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
