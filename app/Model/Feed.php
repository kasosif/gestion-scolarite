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
        'image',
        'date',
        'slug',
        'contenu',
        'type',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function classes(){
        return $this->belongsToMany(Classe::class);
    }
}
