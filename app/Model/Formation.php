<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function partieformations(){
        return $this->hasMany(PartieFormation::class);
    }
}
