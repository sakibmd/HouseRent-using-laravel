<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function houses(){
        return $this->hasMany(House::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
