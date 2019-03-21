<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','coeficient','type'
    ];

    public function mamatiere(){
        return $this->belongsTo('App\Model\Matiere');
    }
}
