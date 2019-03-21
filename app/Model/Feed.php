<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'contenu',
        'type'
    ];

    public function Utilisateur(){
        return $this->belongsTo('App\Model\User');
    }

    public function Classe(){
        return $this->belongsTo('App\Model\Classe');
    }
}
