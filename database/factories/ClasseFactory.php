<?php

use Faker\Generator as Faker;
use App\Model\Classe;

$factory->define(Classe::class, function (Faker $faker) {
    return [
        'promotion' => $faker->numberBetween(1,10),
        'code' => $faker->countryCode,
        'abbreviation' => $faker->streetSuffix,
        'annee_id' => $faker->numberBetween(1,3),
        'specialite_id' => $faker->numberBetween(1,5),
    ];
});
