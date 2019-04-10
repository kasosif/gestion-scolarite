<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $fillable = ['matiere_id','classe_id','user_id'];

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

}
