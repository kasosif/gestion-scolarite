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
        /*Factory('App\Model\Annee',3)->create();
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
        //Factory('App\Model\Matiere',100)->create();
        Factory('App\Model\Classe',25)->create();
        Factory('App\Model\User',1)->states('admin')->create();
        Factory('App\Model\User',3)->states('employe')->create();
        Factory('App\Model\User',140)->states('student')->create();
        Factory('App\Model\User',30)->states('teacher')->create();
        DB::table('matieres')->insert([
            [
                'nom' => 'Anglais',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Francais',
                'coeficient' => 2,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Arabe',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Mathematique',
                'coeficient' => 4,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Histoire',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Geographie',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 7
            ],
            [
                'nom' => 'Anglais',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Francais',
                'coeficient' => 2,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Arabe',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Mathematique',
                'coeficient' => 4,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Histoire',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Geographie',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 8
            ],
            [
                'nom' => 'Anglais',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Francais',
                'coeficient' => 2,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Arabe',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Mathematique',
                'coeficient' => 3,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Programmation',
                'coeficient' => 3,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Base de donnes',
                'coeficient' => 1.5,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Tic',
                'coeficient' => 1.5,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Histoire',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Geographie',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 1
            ],
            [
                'nom' => 'Anglais',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Francais',
                'coeficient' => 2,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Arabe',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Mathematique',
                'coeficient' => 3,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Programmation',
                'coeficient' => 3,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Base de donnes',
                'coeficient' => 1.5,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Tic',
                'coeficient' => 1.5,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Histoire',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
            [
                'nom' => 'Geographie',
                'coeficient' => 1,
                'plafond_abscences' => 5,
                'niveau_id' => 2
            ],
        ]);
        DB::table('seances')->insert([
            ['heure_debut' => new \DateTime('today 09:00'),'heure_fin' => new \DateTime('today 10:30')],
            ['heure_debut' => new \DateTime('today 10:45'),'heure_fin' => new \DateTime('today 12:15')],
            ['heure_debut' => new \DateTime('today 14:00'),'heure_fin' => new \DateTime('today 15:30')],
            ['heure_debut' => new \DateTime('today 15:45'),'heure_fin' => new \DateTime('today 17:15')],
        ]);*/
        //Factory('App\Model\Devoir',10)->create();
        // Factory('App\Model\Feed',15)->create();
        DB::table('privileges')->insert([
            ['titre' => 'view_etudiants'],['titre' => 'update_etudiants'],['titre' => 'delete_etudiants'],['titre' => 'create_etudiants'],
            ['titre' => 'view_abscences'],['titre' => 'delete_abscences'],['titre' => 'create_abscences'],
            ['titre' => 'view_notes'],['titre' => 'update_notes'],['titre' => 'delete_notes'],['titre' => 'create_notes'],
            ['titre' => 'view_professeurs'],['titre' => 'update_professeurs'],['titre' => 'delete_professeurs'],['titre' => 'create_professeurs'],
            ['titre' => 'view_feeds'],['titre' => 'update_feeds'],['titre' => 'delete_feeds'],['titre' => 'create_feeds'],
            ['titre' => 'view_annees'],['titre' => 'update_annees'],['titre' => 'delete_annees'],['titre' => 'create_annees'],
            ['titre' => 'view_semestres'],['titre' => 'update_semestres'],['titre' => 'delete_semestres'],['titre' => 'create_semestres'],
            ['titre' => 'view_specialites'],['titre' => 'update_specialites'],['titre' => 'delete_specialites'],['titre' => 'create_specialites'],
            ['titre' => 'view_classes'],['titre' => 'update_classes'],['titre' => 'delete_classes'],['titre' => 'create_classes'],
            ['titre' => 'view_seances'],['titre' => 'update_seances'],['titre' => 'delete_seances'],['titre' => 'create_seances'],
            ['titre' => 'view_devoirs'],['titre' => 'update_devoirs'],['titre' => 'delete_devoirs'],['titre' => 'create_devoirs'],
            ['titre' => 'view_matieres'],['titre' => 'update_matieres'],['titre' => 'delete_matieres'],['titre' => 'create_matieres'],
            ['titre' => 'view_salles'],['titre' => 'update_salles'],['titre' => 'delete_salles'],['titre' => 'create_salles'],
            ['titre' => 'view_niveaux'],['titre' => 'update_niveaux'],['titre' => 'delete_niveaux'],['titre' => 'create_niveaux'],
            ['titre' => 'view_formations'],['titre' => 'update_formations'],['titre' => 'delete_formations'],['titre' => 'create_formations'],
            ['titre' => 'view_demandes'],['titre' => 'update_demandes'],['titre' => 'delete_demandes'],
            ['titre' => 'view_emplois'],['titre' => 'update_emplois'],['titre' => 'delete_emplois'],['titre' => 'create_emplois'],
        ]);
        DB::table('jours')->insert([
            ['nom'=>'Lundi'],
            ['nom'=>'Mardi'],
            ['nom'=>'Mercredi'],
            ['nom'=>'Jeudi'],
            ['nom'=>'Vendredi'],
            ['nom'=>'Samedi']
        ]);
        for ($i=1;$i<51;$i++){
            DB::table('salles')->insert(['nom'=>'Salle'.' '.$i]);
        }


    }
}
