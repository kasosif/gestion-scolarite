<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
