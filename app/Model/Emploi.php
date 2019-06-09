<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    protected $guarded = [];

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function salle(){
        return $this->belongsTo(Salle::class);
    }

    public function jour(){
        return $this->belongsTo(Jour::class);
    }

    public function seance(){
        return $this->belongsTo(Seance::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }
}
