<?php

namespace App\Providers;

use App\Model\Abscence;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Devoir;
use App\Model\Feed;
use App\Model\Matiere;
use App\Model\Niveau;
use App\Model\Salle;
use App\Model\Seance;
use App\Model\Semestre;
use App\Model\Specialite;
use App\Model\User;
use App\Policies\AbscencePolicy;
use App\Policies\AnneePolicy;
use App\Policies\ClassePolicy;
use App\Policies\DevoirPolicy;
use App\Policies\FeedPolicy;
use App\Policies\MatierePolicy;
use App\Policies\NiveauPolicy;
use App\Policies\SallePolicy;
use App\Policies\SeancePolicy;
use App\Policies\SemestrePolicy;
use App\Policies\SpecialitePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Specialite::class => SpecialitePolicy::class,
        Semestre::class => SemestrePolicy::class,
        Seance::class => SeancePolicy::class,
        Salle::class => SallePolicy::class,
        Matiere::class => MatierePolicy::class,
        Feed::class => FeedPolicy::class,
        Devoir::class => DevoirPolicy::class,
        Classe::class => ClassePolicy::class,
        Annee::class => AnneePolicy::class,
        Abscence::class => AbscencePolicy::class,
        Niveau::class => NiveauPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
