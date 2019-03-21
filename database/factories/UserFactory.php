<?php

use App\Model\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'cin' => strval($faker->unique()->randomNumber($nbDigits = 8,true)),
        'nom' => $faker->firstName,
        'prenom'=> $faker->lastName,
        'date_naissance'=> $faker->dateTimeBetween('-30 years','-18 years'),
        'lieu_naissance'=> $faker->country,
        'gendre'=> $faker->randomElement(['male','female']),
        'role'=> 'ROLE_ADMIN',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => new DateTime(),
        'password' => '$2y$10$Pbsz5HVV7oYBRvUiGcgm0OyOinJfhHuV7zWkivkOlgeDGXVltTc6y', // password
        'remember_token' => Str::random(10),
    ];
});
