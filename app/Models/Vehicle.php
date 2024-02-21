<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id', 
        'name', 
        'vehicle_type', 
        'rent', 
        'cost', 
        'start_date', 
        'end_date', 
        'unit_status', 
        'status', 
        'service_schedule', 
        'fuel', 
        'created_by', 
        'updated_by',
    ];
}
