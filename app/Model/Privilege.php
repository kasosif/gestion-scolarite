<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = ['titre'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
