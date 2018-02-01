<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seeker_id')->unsigned();
            $table->integer('bidder_id')->unsigned();
            $table->foreign('seeker_id')->references('id')->on('users');
            $table->foreign('bidder_id')->references('id')->on('users');
            $table->string('proposal_id')->unsigned();
            $table->foreign('proposal_id')->references('id')->on('proposals');
            $table->string('status');
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
        Schema::dropIfExists('bids');
    }
}
