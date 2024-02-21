<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pemasangan;
use App\Models\Pembayaran;
use App\Models\VehicleUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return VehicleUsage::select(
                'vehicle_usages.id',
                'vehicles.name',
                DB::raw('count(vehicles.id) AS total')
            )
            ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
            ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
            ->join('officers', 'officers.id', 'vehicle_usages.approval_id')
            ->join('users', 'users.id', 'vehicle_usages.approval_second_id')
            ->groupBy('vehicle_usages.id', 'vehicles.name')
            ->get();
        }
        return view('dashboard.index');
    }
}
