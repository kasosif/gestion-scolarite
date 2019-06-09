<?php

use Faker\Generator as Faker;
use App\Model\Classe;
use App\Model\Niveau;

$factory->define(Classe::class, function (Faker $faker) {
    $randomnumber = $faker->unique()->randomNumber($nbDigits = 5);
    return [
        'promotion' => $faker->numberBetween(1,10),
        'code' => 'Cl'.$randomnumber,
        'abbreviation' => 'Classe'.$randomnumber,
        'niveau_id' => Niveau::all()->random()->id,
    ];
});
