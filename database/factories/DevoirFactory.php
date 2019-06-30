<?php

use Faker\Generator as Faker;
use App\Model\Devoir;
use App\Model\Seance;
use App\Model\Matiere;
use App\Model\Classe;
$factory->define(Devoir::class, function (Faker $faker) {
    $randomnumber = $faker->unique()->randomNumber($nbDigits = 5);
    return [
        'nom' => 'Devoir'.$randomnumber,
        'coeficient' => $faker->numberBetween(1,2),
        'date' => $faker->dateTimeBetween('+1 days','+30 days'),
        'type' => $faker->randomElement(['examen','ds']),
        'matiere_id' => Matiere::all()->random()->id,
        'classe_id' => Classe::all()->random()->id,
    ];
});
