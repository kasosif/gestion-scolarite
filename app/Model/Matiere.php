<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','coeficient','nbr_heures','plafond_abscences','horaires'
    ];

    public function Semestre(){
        return $this->belongsTo('App\Model\Semestre');
    }

    public function Professeur(){
        return $this->belongsTo('App\Model\User');
    }

    public function Classe(){
        return $this->belongsTo('App\Model\Classe');
    }

    public function mesdevoirs(){
        return $this->hasMany('App\Model\Devoir');
    }

    public function mesabscences(){
        return $this->hasMany('App\Model\Abscence');
    }



}
