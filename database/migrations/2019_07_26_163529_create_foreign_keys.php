<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::Statement('alter table `specialites` add constraint `specialites_annee_id_foreign` foreign key (`annee_id`) references `annees` (`id`) on delete cascade');
        DB::Statement('alter table `classes` add constraint `classes_niveau_id_foreign` foreign key (`niveau_id`) references `niveaux` (`id`) on delete cascade');
        DB::Statement('alter table `abscences` add constraint `abscences_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `abscences` add constraint `abscences_classe_id_foreign` foreign key (`classe_id`) references `classes` (`id`)');
        DB::Statement('alter table `abscences` add constraint `abscences_matiere_id_foreign` foreign key (`matiere_id`) references `matieres` (`id`) on delete cascade');
        DB::Statement('alter table `abscences` add constraint `abscences_seance_id_foreign` foreign key (`seance_id`) references `seances` (`id`) on delete cascade');
        DB::Statement('alter table `devoirs` add constraint `devoirs_matiere_id_foreign` foreign key (`matiere_id`) references `matieres` (`id`) on delete cascade');
        DB::Statement('alter table `devoirs` add constraint `devoirs_classe_id_foreign` foreign key (`classe_id`) references `classes` (`id`) on delete cascade');
        DB::Statement('alter table `matieres` add constraint `matieres_niveau_id_foreign` foreign key (`niveau_id`) references `niveaux` (`id`) on delete cascade');
        DB::Statement('alter table `matieres` add constraint `matieres_semestre_id_foreign` foreign key (`semestre_id`) references `semestres` (`id`) on delete cascade');
        DB::Statement('alter table `feeds` add constraint `feeds_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `privilege_user` add constraint `privilege_user_privilege_id_foreign` foreign key (`privilege_id`) references `privileges` (`id`) on delete cascade');
        DB::Statement('alter table `privilege_user` add constraint `privilege_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `niveaux` add constraint `niveaux_specialite_id_foreign` foreign key (`specialite_id`) references `specialites` (`id`) on delete cascade');
        DB::Statement('alter table `affectations` add constraint `affectations_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `affectations` add constraint `affectations_matiere_id_foreign` foreign key (`matiere_id`) references `matieres` (`id`) on delete cascade');
        DB::Statement('alter table `affectations` add constraint `affectations_classe_id_foreign` foreign key (`classe_id`) references `classes` (`id`) on delete cascade');
        DB::Statement('alter table `notes` add constraint `notes_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `notes` add constraint `notes_devoir_id_foreign` foreign key (`devoir_id`) references `devoirs` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_classe_id_foreign` foreign key (`classe_id`) references `classes` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_matiere_id_foreign` foreign key (`matiere_id`) references `matieres` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_salle_id_foreign` foreign key (`salle_id`) references `salles` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_jour_id_foreign` foreign key (`jour_id`) references `jours` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_seance_id_foreign` foreign key (`seance_id`) references `seances` (`id`) on delete cascade');
        DB::Statement('alter table `emplois` add constraint `emplois_semestre_id_foreign` foreign key (`semestre_id`) references `semestres` (`id`) on delete cascade');
        DB::Statement('alter table `formations` add constraint `formations_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `formations` add constraint `formations_niveau_id_foreign` foreign key (`niveau_id`) references `niveaux` (`id`) on delete cascade');
        DB::Statement('alter table `partie_formations` add constraint `partie_formations_formation_id_foreign` foreign key (`formation_id`) references `formations` (`id`) on delete cascade');
        DB::Statement('alter table `progression_etudiants` add constraint `progression_etudiants_user_id_foreign` foreign key (`user_id`) references `users` (`id`)');
        DB::Statement('alter table `progression_etudiants` add constraint `progression_etudiants_partie_formation_id_foreign` foreign key (`partie_formation_id`) references `partie_formations` (`id`) on delete cascade');
        DB::Statement('alter table `feed_user` add constraint `feed_user_feed_id_foreign` foreign key (`feed_id`) references `feeds` (`id`) on delete cascade');
        DB::Statement('alter table `feed_user` add constraint `feed_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');
        DB::Statement('alter table `classe_feed` add constraint `classe_feed_classe_id_foreign` foreign key (`classe_id`) references `classes` (`id`) on delete cascade');
        DB::Statement('alter table `classe_feed` add constraint `classe_feed_feed_id_foreign` foreign key (`feed_id`) references `feeds` (`id`) on delete cascade');
        DB::Statement('alter table `demandes` add constraint `demandes_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
