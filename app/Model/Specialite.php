<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','nom_ar','nom_en',
        'code','annee_id'
    ];

    public function niveaux() {
        return $this->hasMany(Niveau::class);
    }

    public function annee(){
        return $this->belongsTo(Annee::class);
    }
}
