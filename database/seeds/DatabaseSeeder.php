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
        Factory('App\Model\Annee',3)->create();
        Factory('App\Model\Specialite',5)->create();
        DB::table('niveaux')->insert([
            ['nom'=>'Niveau 1','specialite_id' => 1],
            ['nom'=>'Niveau 1','specialite_id' => 2],
            ['nom'=>'Niveau 1','specialite_id' => 3],
            ['nom'=>'Niveau 1','specialite_id' => 4],
            ['nom'=>'Niveau 1','specialite_id' => 5],
        ]);
        DB::table('semestres')->insert([
            ['nom'=>'Semestre 1'],
            ['nom'=>'Semestre 2'],
        ]);
        Factory('App\Model\Matiere',15)->create();
        Factory('App\Model\Classe',5)->create();
        Factory('App\Model\User',1)->states('admin')->create();
        Factory('App\Model\User',3)->states('employe')->create();
        Factory('App\Model\User',150)->states('student')->create();
        Factory('App\Model\User',10)->states('teacher')->create();
        DB::table('seances')->insert([
            ['heure_debut' => new \DateTime('today 09:00'),'heure_fin' => new \DateTime('today 10:30')],
            ['heure_debut' => new \DateTime('today 10:45'),'heure_fin' => new \DateTime('today 12:15')],
            ['heure_debut' => new \DateTime('today 14:00'),'heure_fin' => new \DateTime('today 15:30')],
            ['heure_debut' => new \DateTime('today 15:45'),'heure_fin' => new \DateTime('today 17:15')],
        ]);
        Factory('App\Model\Devoir',10)->create();
        Factory('App\Model\Feed',5)->states('classe')->create();
        Factory('App\Model\Feed',5)->states('etudiant')->create();
        Factory('App\Model\Feed',5)->states('professeur')->create();

    }
}
