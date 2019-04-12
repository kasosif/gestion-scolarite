<?php

use Faker\Generator as Faker;
use App\Model\Matiere;
use App\Model\Niveau;
use App\Model\Semestre;
$factory->define(Matiere::class, function (Faker $faker) {
    return [
        'nom' => $faker->jobTitle,
        'coeficient' => $faker->numberBetween(1,4),
        'nbr_heures' => $faker->numberBetween(20,40),
        'plafond_abscences' => $faker->numberBetween(3,6),
        'horaires' => $faker->numberBetween(10,30),
        'niveau_id' => Niveau::all()->random()->id
    ];
});
