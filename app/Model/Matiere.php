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
        'nom','coeficient','plafond_abscences',
        'niveau_id','semestre_id'
    ];

    public function affectations() {
        return $this->hasMany(Affectation::class);
    }

    public function devoirs() {
        return $this->hasMany(Devoir::class);
    }

    public function abscences() {
        return $this->hasMany(Abscence::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }


}
