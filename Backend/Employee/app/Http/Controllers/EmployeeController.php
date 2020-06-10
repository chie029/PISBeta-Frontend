<?php

namespace App\Http\Controllers;

use Hash;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::All();
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
            'employee_basic_information' => 'required',
            'employee_educational_background' => 'required',
            'employee_additional_information' => 'required',
            'employee_position' => 'required',
            'employee_payroll_details' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $employeeid = Employee::select('employee_id')->orderBy('employee_id', 'desc')->first();

            if ($employeeid == null) {
                $newid = "EMP_0001";
            } else {
                $count = explode('_', $employeeid['employee_id']);
                $addcount = $count[1] + 1;
                if ($addcount < 10) { $newid = "EMP_" . "000" . $addcount; } else { $newid = "EMP_" . "00" . $addcount;}
            };

            $employee = Employee::create([
                'employee_id' => $newid,
                'employee_basic_information' => $request['employee_basic_information'],
                'employee_educational_background' => $request['employee_educational_background'],
                'employee_additional_information' => $request['employee_additional_information'],
                'employee_position' => $request['employee_position'],
                'employee_payroll_details' => $request['employee_payroll_details'],
            ]);

            return response()->json([
                'employee' => Employee::where('employee_id', $employee->employee_id)->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'employee_basic_information' => 'required',
            'employee_educational_background' => 'required',
            'employee_additional_information' => 'required',
            'employee_position' => 'required',
            'employee_payroll_details' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'employee_basic_information' => array($request['employee_basic_information']),
                'employee_educational_background' => array($request['employee_educational_background']),
                'employee_additional_information' => array($request['employee_additional_information']),
                'employee_position' => array($request['employee_position']),
                'employee_payroll_details' => array($request['employee_payroll_details']),
            ];

            $employee = Employee::where('employee_id', $request['employee_id'])->update($body);

            return response()->json([
                'employee' => Employee::where('employee_id', $request['employee_id'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }

    public function getNullUser()
    {
        return Employee::select(['employee_id','employee_basic_information'])->get();
    }

    public function assignCompensation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'effective_date' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $requestData = $request->all();
            $requestData['employee_compensation']['effective_date'] = $request['effective_date'];
            $employees = array($request['employees']);

            $body = [
                'employee_compensation' => array($requestData['employee_compensation']),
            ];

            $employee = Employee::whereIn('employee_id', $request['employees'])->update($body);

            return response()->json([
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }
}
