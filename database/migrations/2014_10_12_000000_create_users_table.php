<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('cin',8)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('prenom');
            $table->string('prenom_ar')->nullable();
            $table->string('prenom_en')->nullable();
            $table->string('nom');
            $table->string('nom_ar')->nullable();
            $table->string('nom_en')->nullable();
            $table->string('gendre');
            $table->string('lieu_naissance');
            $table->string('lieu_naissance_ar')->nullable();
            $table->string('lieu_naissance_en')->nullable();
            $table->date('date_naissance');
            $table->string('role');
            $table->unsignedBigInteger('classe_id');
            ////$table->foreign('classe_id')->references('id')->on('classes');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
