<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom'];

    public function matieres(){
        return $this->hasMany('App\Model\Matiere');
    }
}
