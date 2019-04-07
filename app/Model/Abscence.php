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
        'seance_id',
    ];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function matiere(){
        return $this->belongsTo('App\Model\Matiere');
    }

    public function seance(){
        return $this->belongsTo('App\Model\Seance');
    }
}
