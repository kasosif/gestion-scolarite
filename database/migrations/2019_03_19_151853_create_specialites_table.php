<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialites', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('nom_ar')->nullable();
            $table->string('nom_en')->nullable();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('annee_id')->nullable();
            ////$table->foreign('annee_id')->references('id')->on('annees')->onDelete('cascade');

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
        Schema::dropIfExists('specialites');
    }
}
