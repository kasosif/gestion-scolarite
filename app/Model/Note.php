<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['user_id','devoir_id','mark'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function devoir() {
        return $this->belongsTo(Devoir::class);
    }
}
