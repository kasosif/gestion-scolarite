<?php

use Faker\Generator as Faker;
use App\Model\Specialite;

$factory->define(Specialite::class, function (Faker $faker) {
    return [
        'nom' => $faker->colorName,
        'code' => $faker->postcode
    ];
});
