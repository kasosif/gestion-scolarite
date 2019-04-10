<?php

use Faker\Generator as Faker;
use App\Model\Feed;
use App\Model\User;
use App\Model\Classe;
$factory->define(Feed::class, function (Faker $faker) {
    return [
        'titre' => $faker->sentence,
        'date' => $faker->dateTimeBetween('-30 days','now'),
        'contenu' => $faker->paragraph('30'),
    ];
});

$factory->state(Feed::class,'classe',function () {

    return [
        'type' => 'classe',
        'classe_id' => Classe::all()->random()->id
    ];
});

$factory->state(Feed::class,'etudiant',function () {
    return [
        'type' => 'etudiant',
        'user_id' => User::where('role','ROLE_ETUDIANT')->get()->random()->id
    ];
});

$factory->state(Feed::class,'professeur',function () {
    return [
        'type' => 'professeur',
        'user_id' => User::where('role','ROLE_PROFESSEUR')->get()->random()->id
    ];
});
