<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasseFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe_feed', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('classe_id')->unsigned();
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->integer('feed_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('feeds');
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
        Schema::dropIfExists('classe_feed');
    }
}
