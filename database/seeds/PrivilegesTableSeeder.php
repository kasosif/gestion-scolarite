<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            ['titre' => 'view_etudiants'],['titre' => 'update_etudiants'],['titre' => 'delete_etudiants'],['titre' => 'create_etudiants'],
            ['titre' => 'view_abscences'],['titre' => 'update_abscences'],['titre' => 'delete_abscences'],['titre' => 'create_abscences'],
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
        ]);
    }
}
