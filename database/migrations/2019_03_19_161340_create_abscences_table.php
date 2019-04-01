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
            $table->string('justification');
            $table->longText('commentaire');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('matiere_id')->unsigned();
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
            $table->integer('seance_id')->unsigned();
            $table->foreign('seance_id')->references('id')->on('seances')->onDelete('cascade');
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
