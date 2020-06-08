<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'department_name' => 'required',
            'department_head' => 'required',
            'department_description' => 'required',
            'department_status' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $departmentid = Department::select('department_id')->orderBy('department_id', 'desc')->first();

            if ($departmentid == null) {
                $newid = "DEPT_0001";
            } else {
                $count = explode('_', $departmentid['department_id']);
                $addcount = $count[1] + 1;
                if ($addcount < 10) { $newid = "DEPT_" . "000" . $addcount; } else { $newid = "DEPT_" . "00" . $addcount;}
            };

            $departments = Department::create([
                'department_id' => $newid,
                'company_id' => $request['company_id'],
                'department_name' => $request['department_name'],
                'department_head' => $request['department_head'],
                'department_description' => $request['department_description'],
                'department_status' => $request['department_status'],
            ]);

            return response()->json([
                'department' => Department::where('department_id', $departments->department_id)->first(),
                'status' => 'Success',
                'message' => 'Department Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'department_name' => 'required',
            'department_head' => 'required',
            'department_description' => 'required',
            'department_status' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'department_name' => $request['department_name'],
                'department_head' => $request['department_head'],
                'department_description' => $request['department_description'],
                'department_status' => $request['department_status'],
            ];

            $department = Department::where('department_id', $request['department_id'])->update($body);

            return response()->json([
                'department' => Department::where('department_id', $request['department_id'])->first(),
                'status' => 'Success',
                'message' => 'Department Successfully Updated!',
            ]);
        }
    }
}
