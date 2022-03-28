<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'address_line1', 'address_line2', 'address_line3', 'gstin_number', 'city', 'district', 'postal_code', 'state_id', 'consignment_note', 'email', 'phone', 'status', 'created_at', 'updated_at'
    ];

    public function State(){
        return $this->belongsTo('App\Models\State','state_id');
    }
}
