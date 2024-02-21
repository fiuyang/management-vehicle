<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(Vehicle::select('vehicles.id', 'vehicles.name', 'vehicles.vehicle_type', 'companies.name as company_name')->rightJoin('companies', 'companies.id', 'vehicles.company_id'))
                ->addColumn('_', function($data) {
                    return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                            <button type="button" class="btn btn-warning text-light" onclick="edit('.$data->id.')"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="destroy('.$data->id.')"><i class="far fa-trash-alt"></i></button>';
                })
                ->editColumn('vehicle_type', function($data) {
                    return ucwords($data->vehicle_type);
                })
                ->rawColumns(['_', 'vehicle_type'])
                ->make(true);
        }
        return view('vehicle.index');
    }

    public function create() {
        return view('vehicle.create');
    }

    public function insert() {
        $req = request()->all();
        $validator = Validator::make($req, [
            'company_id' => 'required',
            'name' => 'required',
            'vehicle_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }

        if (isset($req['rent'])) {
            $req['start_date'] = date('Y-m-d', strtotime($req['start_date']));
            $req['end_date'] = date('Y-m-d', strtotime($req['end_date']));
            $req['rent'] = 1;
        }
        $req['unit_status'] = 'Ready';
        $req['status'] = 'Ready';
        $req['service_schedule'] = date('Y-m-d', strtotime($req['service_schedule']));
        $req['created_by'] = auth()->user()->username;
        if (Vehicle::create($req)) {
            return response()->json([
                'success' => true,
                'message' => 'Created successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed insert'
            ]);
        }
    }

    public function edit($id) {
        $model = Vehicle::select('vehicles.*', 'companies.name as company_name')->join('companies', 'companies.id', 'vehicles.company_id')->where('vehicles.id', $id)->first();
        return view('vehicle.edit', compact('model'));
    }

    public function view($id) {
        $model = Vehicle::select('vehicles.*', 'companies.name as company_name')->join('companies', 'companies.id', 'vehicles.company_id')->where('vehicles.id', $id)->first();
        return view('vehicle.view', compact('model'));
    }

    public function update($id) {
        $req = request()->all();
        $validator = Validator::make($req, [
            'company_id' => 'required',
            'name' => 'required',
            'vehicle_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }
        
        if (isset($req['rent'])) {
            $req['start_date'] = date('Y-m-d', strtotime($req['start_date']));
            $req['end_date'] = date('Y-m-d', strtotime($req['end_date']));
            $req['rent'] = 1;
        }
        $req['updated_by'] = auth()->user()->username;
        $req['unit_status'] = 'Ready';
        $req['status'] = 'Ready';
        $req['service_schedule'] = date('Y-m-d', strtotime($req['service_schedule']));

        $model = Vehicle::find($id);
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
        $model = Vehicle::findOrFail($id);
        if ($model->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Deleted succesfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed deleted'
            ]);
        }
    }
}
