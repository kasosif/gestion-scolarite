<?php

use Faker\Generator as Faker;
use App\Model\Annee;
$factory->define(Annee::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeThisYear('+1 month');
    $endingDate = $faker->dateTimeThisYear('+1 year');
    return [
        'nom' => $faker->name,
        'date_debut' => $startingDate,
        'date_fin' => $endingDate,
        'code' => $faker->countryCode
    ];
});
