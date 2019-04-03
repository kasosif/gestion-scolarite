<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Factory('App\Model\User',1)->states('admin')->create();
        Factory('App\Model\User',3)->states('employe')->create();
        Factory('App\Model\User',5)->states('student')->create();
        Factory('App\Model\User',5)->states('teacher')->create();
        Factory('App\Model\Annee',3)->create();
        Factory('App\Model\Classe',10)->create();
        Factory('App\Model\Specialite',5)->create();
    }
}
