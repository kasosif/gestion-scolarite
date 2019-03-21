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
        'code'
    ];

    public function mesclasses(){
        return $this->hasMany('App\Model\Classe');
    }
}
