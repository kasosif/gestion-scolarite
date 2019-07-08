<?php

use App\Model\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Model\Classe;
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
    $nom = $faker->lastName;
    $prenom =$faker->firstName;
    $lieu =$faker->country;
    return [
        'cin' => strval($faker->unique()->randomNumber($nbDigits = 8,true)),
        'nom' => $nom,
        'nom_ar' => $nom,
        'prenom'=> $prenom,
        'prenom_ar'=> $nom,
        'date_naissance'=> $faker->dateTimeBetween('-30 years','-18 years'),
        'lieu_naissance'=> $lieu,
        'lieu_naissance_ar'=> $lieu,
        'gendre'=> $faker->randomElement(['male','female']),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => new DateTime(),
        'password' => 'secret',
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class,'admin',function () {
    return [
        'role' => 'ROLE_ADMIN'
    ];
});
$factory->state(User::class,'employe',function () {
    return [
        'role' => 'ROLE_EMPLOYE'
    ];
});
$factory->state(User::class,'teacher',function () {
    return [
        'role' => 'ROLE_PROFESSEUR'
    ];
});
$factory->state(User::class,'student',function () {
    return [
        'role' => 'ROLE_ETUDIANT',
        'classe_id' => Classe::all()->random()->id,
    ];
});
