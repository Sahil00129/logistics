<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'maplocation_id', 'vehcapacity_id', 'payment_type', 'payment_to', 'purchase_price', 'advance_payment', 'pending_payment', 'status','created_at','updated_at'        
    ];
    
    public function stops(){
        return $this->hasMany('App\Models\StopHistory','payment_id');
    }
}
