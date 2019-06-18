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

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function classes(){
        return $this->belongsToMany(Classe::class);
    }
}
