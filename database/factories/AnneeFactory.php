<?php

use Faker\Generator as Faker;
use App\Model\Annee;
$factory->define(Annee::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeThisYear('+1 year');
    $endingDate = $faker->dateTimeThisYear('+1 year');
    return [
        'nom' => $startingDate->format('Y').'-'.$endingDate->format('Y'),
        'date_debut' => $startingDate,
        'date_fin' => $endingDate,
        'code' => $startingDate->format('Y').''.$endingDate->format('Y')
    ];
});
