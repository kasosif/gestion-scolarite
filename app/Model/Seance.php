<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heure_debut','heure_fin',
    ];

    public function mesabscences(){
        return $this->hasMany('App\Model\Abscence');
    }
}
