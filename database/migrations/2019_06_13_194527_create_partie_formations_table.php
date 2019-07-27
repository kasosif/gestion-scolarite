<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartieFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partie_formations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->integer('indice');
            $table->string('titre');
            $table->string('cover');
            $table->string('coverimage')->nullable();
            $table->unsignedBigInteger('formation_id');
            //$table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
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
        Schema::dropIfExists('partie_formations');
    }
}
