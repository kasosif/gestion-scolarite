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
        'nom','coeficient','nbr_heures','plafond_abscences','horaires',
        'semestre_id','user_id','classe_id',
    ];

    public function semestre(){
        return $this->belongsTo('App\Model\Semestre');
    }

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function classe(){
        return $this->belongsTo('App\Model\Classe');
    }

    public function devoirs(){
        return $this->hasMany('App\Model\Devoir');
    }

    public function abscences(){
        return $this->hasMany('App\Model\Abscence');
    }



}
