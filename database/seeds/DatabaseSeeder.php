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
////        Factory('App\Model\Annee',3)->create();
////        Factory('App\Model\Specialite',5)->create();
////        DB::table('niveaux')->insert([
////            ['nom'=>'Niveau 1','specialite_id' => 1],
////            ['nom'=>'Niveau 1','specialite_id' => 2],
////            ['nom'=>'Niveau 1','specialite_id' => 3],
////            ['nom'=>'Niveau 1','specialite_id' => 4],
////            ['nom'=>'Niveau 1','specialite_id' => 5],
////        ]);
////        DB::table('semestres')->insert([
////            ['nom'=>'Semestre 1'],
////            ['nom'=>'Semestre 2'],
////        ]);
////        Factory('App\Model\Matiere',100)->create();
////        Factory('App\Model\Classe',25)->create();
////        Factory('App\Model\User',1)->states('admin')->create();
////        Factory('App\Model\User',3)->states('employe')->create();
////        Factory('App\Model\User',140)->states('student')->create();
////        Factory('App\Model\User',30)->states('teacher')->create();
//        DB::table('matieres')->insert([
//            [
//                'nom' => 'Anglais',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Francais',
//                'coeficient' => 2,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Arabe',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Mathematique',
//                'coeficient' => 4,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Histoire',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Geographie',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 7
//            ],
//            [
//                'nom' => 'Anglais',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Francais',
//                'coeficient' => 2,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Arabe',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Mathematique',
//                'coeficient' => 4,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Histoire',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Geographie',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 8
//            ],
//            [
//                'nom' => 'Anglais',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Francais',
//                'coeficient' => 2,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Arabe',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Mathematique',
//                'coeficient' => 3,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Programmation',
//                'coeficient' => 3,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Base de donnes',
//                'coeficient' => 1.5,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Tic',
//                'coeficient' => 1.5,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Histoire',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Geographie',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 1
//            ],
//            [
//                'nom' => 'Anglais',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Francais',
//                'coeficient' => 2,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Arabe',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Mathematique',
//                'coeficient' => 3,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Programmation',
//                'coeficient' => 3,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Base de donnes',
//                'coeficient' => 1.5,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Tic',
//                'coeficient' => 1.5,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Histoire',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//            [
//                'nom' => 'Geographie',
//                'coeficient' => 1,
//                'plafond_abscences' => 5,
//                'niveau_id' => 2
//            ],
//        ]);
////        DB::table('seances')->insert([
////            ['heure_debut' => new \DateTime('today 09:00'),'heure_fin' => new \DateTime('today 10:30')],
////            ['heure_debut' => new \DateTime('today 10:45'),'heure_fin' => new \DateTime('today 12:15')],
////            ['heure_debut' => new \DateTime('today 14:00'),'heure_fin' => new \DateTime('today 15:30')],
////            ['heure_debut' => new \DateTime('today 15:45'),'heure_fin' => new \DateTime('today 17:15')],
////        ]);
////        Factory('App\Model\Devoir',10)->create();
////        Factory('App\Model\Feed',15)->create();
        DB::table('privileges')->insert([
            ['titre' => 'view_etudiants', 'ressource' => 'Etudiants'],['titre' => 'update_etudiants', 'ressource' => 'Etudiants'],['titre' => 'delete_etudiants', 'ressource' => 'Etudiants'],['titre' => 'create_etudiants', 'ressource' => 'Etudiants'],
            ['titre' => 'view_abscences_etudiant', 'ressource' => 'Abcences'],['titre' => 'delete_abscences_etudiant', 'ressource' => 'Abcences'],['titre' => 'create_abscences_etudiant', 'ressource' => 'Abcences'],
            ['titre' => 'view_abscences_professeur', 'ressource' => 'Abcences'],['titre' => 'delete_abscences_professeur', 'ressource' => 'Abcences'],['titre' => 'create_abscences_professeur', 'ressource' => 'Abcences'],
            ['titre' => 'view_notes', 'ressource' => 'Notes'],['titre' => 'update_notes', 'ressource' => 'Notes'],['titre' => 'delete_notes', 'ressource' => 'Notes'],['titre' => 'create_notes', 'ressource' => 'Notes'],
            ['titre' => 'view_professeurs', 'ressource' => 'Professeurs'],['titre' => 'update_professeurs', 'ressource' => 'Professeurs'],['titre' => 'delete_professeurs', 'ressource' => 'Professeurs'],['titre' => 'create_professeurs', 'ressource' => 'Professeurs'],
            ['titre' => 'view_feeds', 'ressource' => 'Actualitées'],['titre' => 'update_feeds', 'ressource' => 'Actualitées'],['titre' => 'delete_feeds', 'ressource' => 'Actualitées'],['titre' => 'create_feeds', 'ressource' => 'Actualitées'],
            ['titre' => 'view_annees', 'ressource' => 'Années scolaires'],['titre' => 'update_annees', 'ressource' => 'Années scolaires'],['titre' => 'delete_annees', 'ressource' => 'Années scolaires'],['titre' => 'create_annees', 'ressource' => 'Années scolaires'],
            ['titre' => 'view_semestres', 'ressource' => 'Semestres'],['titre' => 'update_semestres', 'ressource' => 'Semestres'],['titre' => 'delete_semestres', 'ressource' => 'Semestres'],['titre' => 'create_semestres', 'ressource' => 'Semestres'],
            ['titre' => 'view_specialites', 'ressource' => 'Spécialités'],['titre' => 'update_specialites', 'ressource' => 'Spécialités'],['titre' => 'delete_specialites', 'ressource' => 'Spécialités'],['titre' => 'create_specialites', 'ressource' => 'Spécialités'],
            ['titre' => 'view_classes', 'ressource' => 'Classes'],['titre' => 'update_classes', 'ressource' => 'Classes'],['titre' => 'delete_classes', 'ressource' => 'Classes'],['titre' => 'create_classes', 'ressource' => 'Classes'],
            ['titre' => 'view_seances', 'ressource' => 'Séances'],['titre' => 'update_seances', 'ressource' => 'Séances'],['titre' => 'delete_seances', 'ressource' => 'Séances'],['titre' => 'create_seances', 'ressource' => 'Séances'],
            ['titre' => 'view_devoirs', 'ressource' => 'Devoirs'],['titre' => 'update_devoirs', 'ressource' => 'Devoirs'],['titre' => 'delete_devoirs', 'ressource' => 'Devoirs'],['titre' => 'create_devoirs', 'ressource' => 'Devoirs'],
            ['titre' => 'view_matieres', 'ressource' => 'Matieres'],['titre' => 'update_matieres', 'ressource' => 'Matieres'],['titre' => 'delete_matieres', 'ressource' => 'Matieres'],['titre' => 'create_matieres', 'ressource' => 'Matieres'],
            ['titre' => 'view_salles', 'ressource' => 'Salles'],['titre' => 'update_salles', 'ressource' => 'Salles'],['titre' => 'delete_salles', 'ressource' => 'Salles'],['titre' => 'create_salles', 'ressource' => 'Salles'],
            ['titre' => 'view_niveaux', 'ressource' => 'Niveaux scolaires'],['titre' => 'update_niveaux', 'ressource' => 'Niveaux scolaires'],['titre' => 'delete_niveaux', 'ressource' => 'Niveaux scolaires'],['titre' => 'create_niveaux', 'ressource' => 'Niveaux scolaires'],
            ['titre' => 'view_formations', 'ressource' => 'Formations'],['titre' => 'update_formations', 'ressource' => 'Formations'],['titre' => 'delete_formations', 'ressource' => 'Formations'],['titre' => 'create_formations', 'ressource' => 'Formations'],
            ['titre' => 'view_demandes', 'ressource' => 'Demandes'],['titre' => 'update_demandes', 'ressource' => 'Demandes'],['titre' => 'delete_demandes', 'ressource' => 'Demandes'],
            ['titre' => 'view_emplois', 'ressource' => 'Emplois de temps'],['titre' => 'update_emplois', 'ressource' => 'Emplois de temps'],['titre' => 'delete_emplois', 'ressource' => 'Emplois de temps'],['titre' => 'create_emplois', 'ressource' => 'Emplois de temps']
        ]);
////        DB::table('jours')->insert([
////            ['nom'=>'Lundi'],
////            ['nom'=>'Mardi'],
////            ['nom'=>'Mercredi'],
////            ['nom'=>'Jeudi'],
////            ['nom'=>'Vendredi'],
////            ['nom'=>'Samedi']
////        ]);
////        for ($i=1;$i<51;$i++){
////            DB::table('salles')->insert(['nom'=>'Salle'.' '.$i]);
////        }
//
//
    }
}
