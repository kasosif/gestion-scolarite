<?php

use Faker\Generator as Faker;
use App\Model\Specialite;
use App\Model\Annee;

$factory->define(Specialite::class, function (Faker $faker) {
    return [
        'nom' => $faker->colorName,
        'code' => $faker->postcode,
        'annee_id' => Annee::all()->random()->id,
    ];
});
