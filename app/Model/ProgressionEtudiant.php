<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProgressionEtudiant extends Model
{
    protected $guarded = [];

    public function partieformation(){
        return $this->belongsTo(PartieFormation::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
