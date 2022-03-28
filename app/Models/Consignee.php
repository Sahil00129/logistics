<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nick_name', 'legal_name', 'branch_id', 'consigner_id', 'dealer_type', 'gst_number', 'contact_name', 'phone', 'email', 'sales_officer_name', 'sales_officer_email', 'sales_officer_phone', 'address_line1', 'address_line2', 'address_line3', 'city', 'district', 'postal_code', 'state_id', 'status', 'created_at', 'updated_at'
    ];

    public function Branch(){
        return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function State(){
        return $this->belongsTo('App\Models\State','state_id');
    }

    public function Consigner(){
        return $this->belongsTo('App\Models\Consigner','consigner_id');
    }

    public function GetConsigner(){
        return $this->hasOne('App\models\Consigner','id','consigner_id');
    }

    public function GetBranch(){
        return $this->hasOne('App\models\Branch','id','branch_id');
    }

    public function GetState(){
        return $this->hasOne('App\models\State','id','state_id');
    }

}
