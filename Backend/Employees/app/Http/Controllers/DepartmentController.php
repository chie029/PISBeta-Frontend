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
            'company' => 'required',
            'name' => 'required',
            'head' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $department_id = Department::select('department_id')->orderBy('department_id', 'desc')->first();

            if ($department_id == null) {
                $new_id = "DEPT_0001";
            } else {
                $count = explode('_', $department_id['department_id']);
                $add_count = $count[1] + 1;
                if ($add_count < 10) { $new_id = "DEPT_" . "000" . $add_count; } else { $new_id = "DEPT_" . "00" . $add_count;}
            };

            $departments = Department::create([
                'department_id' => $new_id,
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
