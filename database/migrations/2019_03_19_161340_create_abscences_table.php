<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbscencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abscences', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->date('date');
            $table->boolean('justifie');
            $table->string('justification')->nullable();
            $table->longText('commentaire')->nullable();
            $table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('classe_id')->nullable();
            //$table->foreign('classe_id')->references('id')->on('classes');
            $table->unsignedBigInteger('matiere_id');
            //$table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
            $table->unsignedBigInteger('seance_id');
            //$table->foreign('seance_id')->references('id')->on('seances')->onDelete('cascade');
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
        Schema::dropIfExists('abscences');
    }
}
