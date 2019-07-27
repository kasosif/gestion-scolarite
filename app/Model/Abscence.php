<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Abscence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'justifie',
        'commentaire',
        'justification',
        'user_id',
        'matiere_id',
        'classe_id',
        'seance_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }

    public function seance(){
        return $this->belongsTo(Seance::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }
}
