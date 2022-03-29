<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id', 'name', 'email', 'phone', 'gst_number', 'pan_number', 'agent_type', 'is_lane_approved', 'address', 'pan_card', 'cancel_cheque', 'status','created_at','updated_at'        
    ];

    public function Agent()
    {
        return $this->hasOne('App\models\Bank','agent_id','id');
    }
}
