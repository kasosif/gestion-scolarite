<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','nom_ar',
        'date_debut','date_fin',
        'code'
    ];

    public function specialites() {
        return $this->hasMany(Specialite::class);
    }

}
