<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','coeficient','date','type',
        'matiere_id','classe_id'
    ];

    public function notes() {
        return $this->hasMany(Note::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function matiere(){
        return $this->belongsTo(Matiere::class);
    }
}
