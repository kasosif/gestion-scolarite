<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cin','email', 'password','image',
        'prenom','prenom_ar','prenom_en',
        'nom','nom_ar','nom_en',
        'gendre',
        'lieu_naissance','lieu_naissance_ar','lieu_naissance_en',
        'date_naissance',
        'role',
        'classe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feeds(){
        return $this->hasMany('App\Model\Feed');
    }

    public function abscences(){
        return $this->hasMany('App\Model\Abscence');
    }

    public function classe(){
        return $this->belongsTo('App\Model\Classe');
    }

    public function matieres(){
        return $this->hasMany('App\Model\Matiere');
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }





}
