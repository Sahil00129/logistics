<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StopHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'maplocation_id', 'lr_number', 'lr_date', 'gross_wt', 'truck_number', 'invoice_number', 'status','created_at','updated_at'
    ];
    
}
