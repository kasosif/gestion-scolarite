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
        'type' => 'classes',
        'user_id' => User::where('role', 'ROLE_PROFESSEUR')
                    ->orWhere('role', 'ROLE_ADMIN')
                    ->orWhere('role', 'ROLE_EMPLOYE')
                    ->get()
                    ->random()->id
    ];
});
