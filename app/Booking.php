<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function landlord(){
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function renter(){
        return $this->belongsTo(User::class, 'renter_id');
    }
}
