<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('semaine');
            $table->unsignedBigInteger('user_id')->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('classe_id');
            //$table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->unsignedBigInteger('matiere_id')->nullable();
            //$table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
            $table->unsignedBigInteger('salle_id')->nullable();
            //$table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');
            $table->unsignedBigInteger('jour_id');
            //$table->foreign('jour_id')->references('id')->on('jours')->onDelete('cascade');
            $table->unsignedBigInteger('seance_id');
            //$table->foreign('seance_id')->references('id')->on('seances')->onDelete('cascade');
            $table->unsignedBigInteger('semestre_id')->nullable();
            //$table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
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
        Schema::dropIfExists('emplois');
    }
}
