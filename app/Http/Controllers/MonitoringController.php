<?php

namespace App\Http\Controllers;

use App\Models\VehicleOrders;
use App\Models\VehicleUsage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonitoringController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(VehicleUsage::select('vehicle_usages.*', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status', 'vehicles.unit_status', 'vehicles.fuel', 'vehicles.service_schedule')
                ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
                ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
                ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id'))
                ->editColumn('status', function($data) {
                    $html = "";
                    if ($data->status == "Ready") {
                        $html = '<button type="button" class="badge badge-success">Ready</button>';
                    } else if ($data->status == "Booking") {
                        $html = '<button type="button" class="badge badge-warning">Booking</button>';
                    }
                    return $html;
                })
                ->editColumn('status_unit', function($data) {
                    $html = "";
                    if ($data->status == 'Ready') {
                        $html = '<button type="button" class="badge badge-success">Ready</button>';
                    } else if ($data->status == 'Use') {
                        $html = '<button type="button" class="badge badge-warning">Use</button>';
                    } else {
                        $html = '<button type="button" class="badge badge-danger">Broken</button>';
                    }
                    return $html;
                })
                ->rawColumns(['_', 'status', 'unit_status'])
                ->make(true);
        }
        return view('monitoring.index');
    }
}
