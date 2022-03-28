<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consigner extends Model
{
    use HasFactory;
    protected $fillable = [
        'nick_name', 'legal_name', 'gst_number', 'contact_name', 'phone', 'branch_id', 'email', 'address_line1', 'address_line2', 'address_line3', 'city', 'district', 'postal_code', 'state_id', 'status', 'created_at', 'updated_at'
    ];

    public function Branch(){
        return $this->belongsTo('App\models\Branch','branch_id');
    }

    public function State(){
        return $this->belongsTo('App\models\State','state_id');
    }

}
