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
        'date',
        'contenu',
        'type',
        'classe_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function classe(){
        return $this->belongsTo('App\Model\Classe');
    }
}
