<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadQuarterAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address', 'city', 'district', 'postal_code', 'status', 'created_at','updated_at'
    ];
    
}
