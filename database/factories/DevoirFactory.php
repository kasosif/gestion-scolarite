<?php

use Faker\Generator as Faker;
use App\Model\Devoir;
use App\Model\Matiere;
use App\Model\Classe;
$factory->define(Devoir::class, function (Faker $faker) {
    return [
        'nom' => $faker->streetName,
        'coeficient' => $faker->numberBetween(1,2),
        'date' => $faker->dateTimeBetween('+1 days','+30 days'),
        'type' => $faker->randomElement(['examen','ds']),
        'matiere_id' => Matiere::all()->random()->id,
        'classe_id' => Classe::all()->random()->id,
    ];
});
