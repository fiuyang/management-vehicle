<?php

namespace App\Http\Controllers;

use App\Models\VehicleUsage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Exports\HistoryOrderVehicleExport;

class VehicleOrderController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(VehicleUsage::select('vehicle_usages.*', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status AS status_vehicle', 'vehicles.unit_status', 'vehicles.fuel', 'vehicles.service_schedule')
                ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
                ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
                ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id'))
                ->addColumn('_', function($data) {
                    if (auth()->user()->role == 'officer') {
                        if ($data->status == 'Approve') {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="reject('.$data->id.')"><i class="fas fa-times"></i></button>';
                        } else {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-success" onclick="approve_by_officer('.$data->id.')"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="reject('.$data->id.')"><i class="fas fa-times"></i></button>';
                        }
                    } else {
                        if ($data->status == 'Approve') {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>';
                        } else {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-success" onclick="approve('.$data->id.')"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-warning text-light" onclick="edit('.$data->id.')"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="destroy('.$data->id.')"><i class="far fa-trash-alt"></i></button>';
                        }
                    }
                })
                ->editColumn('status', function($data) {
                    $html = "";
                    if ($data->status == 'Approve') {
                        $html = '<button type="button" class="badge badge-success">Approve</button>';
                    } else if ($data->status == 'Waiting') {
                        $html = '<button type="button" class="badge badge-warning">Waiting</button>';
                    } else {
                        $html = '<button type="button" class="badge badge-danger">Reject</button>';
                    }
                    return $html;
                })
                ->rawColumns(['_', 'status', 'officer_name'])
                ->make(true);
        }
        return view('vehicle_usage.index');
    }

    public function create() {
        return view('vehicle_usage.create');
    }

    public function insert() {
        $req = request()->all();
        $validator = Validator::make($req, [
            'employee_id' => 'required',
            'vehicle_id' => 'required',
            'order_destination' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }

        $req['created_by'] = auth()->user()->username;
        $req['status'] = 'Waiting';
        if (VehicleUsage::create($req)) {
            return response()->json([
                'success' => true,
                'message' => 'Created successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed created'
            ]);
        }
    }

    public function edit($id) {
        $model = VehicleUsage::select('vehicle_usages.*', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status AS status_vehicle', 'vehicles.unit_status', 'vehicles.fuel', 'vehicles.service_schedule')
            ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
            ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
            ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id')
            ->where('vehicle_usages.id', $id)->first();
        return view('vehicle_usage.edit', compact('model'));
    }

    public function view($id) {
        $model = VehicleUsage::select('vehicle_usages.*', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status AS status_vehicle', 'vehicles.unit_status', 'vehicles.fuel', 'vehicles.service_schedule')
            ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
            ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
            ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id')
            ->where('vehicle_usages.id', $id)->first();
        return view('vehicle_usage.view', compact('model'));
    }

    public function update($id) {
        $req = request()->all();
        $validator = Validator::make($req, [
            'employee_id' => 'required',
            'vehicle_id' => 'required',
            'order_destination' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }

        $req['updated_by'] = auth()->user()->username;
        $model = VehicleUsage::find($id);
        if ($model->update($req)) {
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed updated'
            ]);
        }
    }

    public function destroy($id) {
        $model = VehicleUsage::findOrFail($id);
        if ($model->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed deleted'
            ]);
        }
    }

    public function approve($id) {
        $model = VehicleUsage::select('vehicle_usages.*', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status AS status_vehicle', 'vehicles.unit_status', 'vehicles.fuel', 'vehicles.service_schedule')
            ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
            ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
            ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id')
            ->where('vehicle_usages.id', $id)->first();
        return view('vehicle_usage.approve', compact('model'));
    }

    public function approved($id) {
        $req = request()->all();
        $model = VehicleUsage::findOrFail($id);
        $data = [
            'approval_id' => $req['approval_id'],
            'status' => 'Waiting'
        ];
        if ($model->update($data)) {
            $response = [
                'success' => true,
                'message' => 'Updated successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed updated'
            ];
        }
       
        return response()->json($response);
    }

    public function approvedByOfficer($id) {
        $model = VehicleUsage::findOrFail($id);
        if (auth()->user()->role == 'officer') {
            if ($model->update(['approval_second_id' => auth()->user()->id, 'status' => 'Approve'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Approval successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed approval'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user has no authority'
            ]);
        }
    }

    public function reject($id) {
        $model = VehicleUsage::findOrFail($id);
        if (auth()->user()->role == 'officer') {
            if ($model->update(['approval_second_id' => NULL, 'status' => 'Waiting'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Rejected successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed rejected'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user has no authority'
            ]);
        }
    }

    public function export()
    {
        $filename = 'history_order_vehicle' . date('Y_m_d-H_i_s') . '.xlsx';

        return Excel::download(new HistoryOrderVehicleExport, $filename);
    }
}
