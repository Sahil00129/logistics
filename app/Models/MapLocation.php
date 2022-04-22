<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'origin','destination','address','latitude','longitude','vehcapacity_id','payment_type','payment_to','paytobroker_id','paytodriver_id','purchase_price','number_stops','status','created_at','updated_at'
    ];

    public function PaymentHistory(){
        return $this->hasMany('App\Models\PaymentHistory','maplocation_id');
    }

    public function StopHistory(){
        return $this->hasMany('App\Models\StopHistory','maplocation_id');
    }

    public function GetVehicle(){
        return $this->hasOne('App\Models\VehicleCapacity','id','vehcapacity_id');
    }
    public function GetDriver(){
        return $this->hasOne('App\Models\Driver','id','paytodriver_id');
    }
    public function GetBroker(){
        return $this->hasOne('App\Models\Broker','id','paytobroker_id');
    }

}
