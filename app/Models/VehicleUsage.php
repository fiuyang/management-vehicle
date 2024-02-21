<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleUsage extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_id', 'employee_id', 'order_destination', 'status', 'approval_id', 'approval_second_id', 'created_by', 'updated_by'];
}
