<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartieFormation extends Model
{
    protected $guarded = [];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }

    public function progressionetudiants(){
        return $this->hasMany(ProgressionEtudiant::class);
    }
}
