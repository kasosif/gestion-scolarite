<?php

use Faker\Generator as Faker;
use App\Model\Specialite;
use App\Model\Annee;

$factory->define(Specialite::class, function (Faker $faker) {
    $randomnumber = $faker->unique()->randomNumber($nbDigits = 5);
    return [
        'nom' => 'Specialite'.$randomnumber,
        'code' => 'S'.$randomnumber,
        'annee_id' => Annee::all()->random()->id,
    ];
});
