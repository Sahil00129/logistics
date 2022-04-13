<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'origin', 'destination', 'address', 'latitude', 'longitude', 'number_stops', 'status','created_at','updated_at'
    ];

    public function PaymentHistory(){
        return $this->hasMany('App\Models\PaymentHistory','maplocation_id');
    }

}
