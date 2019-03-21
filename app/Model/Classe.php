<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promotion',
        'code',
        'abbreviation'
    ];

    public function myfeeds(){
        return $this->hasMany('App\Model\Feed');
    }

    public function mesetudiants(){
        return $this->hasMany('App\Model\User');
    }

    public function mesmatieres(){
        return $this->hasMany('App\Model\Matiere');
    }

    public function maspecialite(){
        return $this->belongsTo('App\Model\Specialite');
    }

    public function monannee(){
        return $this->belongsTo('App\Model\Annee');
    }


}
