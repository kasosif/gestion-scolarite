<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = ['nom','specialite_id'];

    public function classes() {
        return $this->hasMany(Classe::class);
    }

    public function matieres() {
        return $this->hasMany(Matiere::class);
    }

    public function specialite(){
        return $this->belongsTo(Specialite::class);
    }

}
