<?php

use Faker\Generator as Faker;
use App\Model\Matiere;
use App\Model\Niveau;
use App\Model\Semestre;
$factory->define(Matiere::class, function (Faker $faker) {
    $randomnumber = $faker->unique()->randomNumber($nbDigits = 5);
    return [
        'nom' => 'Matiere'.$randomnumber,
        'coeficienbr_heuresnt' => $faker->numberBetween(1,4),
        '' => $faker->numberBetween(20,40),
        'plafond_abscences' => $faker->numberBetween(3,6),
        'horaires' => $faker->numberBetween(10,30),
        'niveau_id' => Niveau::all()->random()->id
    ];
});
