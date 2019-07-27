<?php

namespace App\Model;

use App\Notifications\ApiResetPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notes() {
        return $this->hasMany(Note::class);
    }

    public function abscences() {
        return $this->hasMany(Abscence::class);
    }

    public function feeds() {
        return $this->belongsToMany(Feed::class);
    }

    public function affectations() {
        return $this->hasMany(Affectation::class);
    }

    public function progressionetudiants() {
        return $this->hasMany(ProgressionEtudiant::class);
    }

    public function formations() {
        return $this->hasMany(Formation::class);
    }

    public function privileges(){
        return $this->belongsToMany(Privilege::class);
    }

    public function demandes() {
        return $this->hasMany(Demande::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if(($this->role == 'ROLE_ADMIN') || ($this->role == 'ROLE_EMPLOYE')) {
            $this->notify(new ResetPasswordNotification($token));
        } else {
            $this->notify(new ApiResetPasswordNotification($token));
        }
    }





}
