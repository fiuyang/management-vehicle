<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(Company::select('*'))->make(true);
        }
        return view('company.index');
    }

    public function create() {
        return view('company.create');
    }

    public function insert() {
        $req = request()->all();
        $validator = Validator::make($req, [
            'name' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }

        $req['created_by'] = auth()->user()->username;
        if (Company::create($req)) {
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
        $model = Company::find($id);
        return view('company.edit', compact('model'));
    }

    public function view($id) {
        $model = Company::find($id);
        return view('company.view', compact('model'));
    }

    public function update($id) {
        $req = request()->all();
        $validator = Validator::make($req, [
            'name' => 'required|unique:companies,name,'.$id,
            'address' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'invalid input',
                'errors' => $validator->errors()
            ], 400);
        }

        $req['updated_by'] = auth()->user()->username;
        $model = Company::find($id);
        if ($model->update($req)) {
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to updated'
            ]);
        }
    }

    public function destroy($id) {
        $model = Company::findOrFail($id);
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
}
