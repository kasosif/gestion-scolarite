<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nom');
            $table->double('coeficient');
            $table->integer('plafond_abscences');
            $table->unsignedBigInteger('niveau_id')->nullable();
            $table->unsignedBigInteger('semestre_id')->nullable();
            ////$table->foreign('niveau_id')->references('id')->on('niveaux')->onDelete('cascade');
            ////$table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
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
        Schema::dropIfExists('matieres');
    }
}
