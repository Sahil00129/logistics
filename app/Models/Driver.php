<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'license_number', 'license_image', 'status','created_at','updated_at'        
    ];
}
