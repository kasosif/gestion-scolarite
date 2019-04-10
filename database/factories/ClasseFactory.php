<?php

use Faker\Generator as Faker;
use App\Model\Classe;
use App\Model\Niveau;

$factory->define(Classe::class, function (Faker $faker) {
    return [
        'promotion' => $faker->numberBetween(1,10),
        'code' => $faker->countryCode,
        'abbreviation' => $faker->streetSuffix,
        'niveau_id' => Niveau::all()->random()->id,
    ];
});
