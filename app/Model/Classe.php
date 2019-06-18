<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promotion',
        'code',
        'abbreviation',
        'niveau_id'
    ];

    public function affectations() {
        return $this->hasMany(Affectation::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function feeds() {
        return $this->belongsToMany(Feed::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }


}
