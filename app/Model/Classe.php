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
        'abbreviation',
        'annee_id',
        'specialite_id'
    ];

    public function feeds(){
        return $this->hasMany('App\Model\Feed');
    }

    public function users(){
        return $this->hasMany('App\Model\User');
    }

    public function matieres(){
        return $this->hasMany('App\Model\Matiere');
    }

    public function specialite(){
        return $this->belongsTo('App\Model\Specialite');
    }

    public function annee(){
        return $this->belongsTo('App\Model\Annee');
    }


}
