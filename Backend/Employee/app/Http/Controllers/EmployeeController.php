<?php

namespace App\Http\Controllers;

use Hash;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee_model = new Employee();
        $employee = [];
        $error = [];

        $rows = $request->get('show') ? (int)$request->get('show') : 10;

        // Search
        if($request->has('search')) $employee = $employee_model->search($request->get('search'));

        // Sorting
        if(!empty($request->get('sort_in')) && !empty($request->get('sort_by')))  $employee = $employee_model->sorting($request->sort_in, $request->sort_by);

        // Paginate
        if ($employee == null) $employee = $employee_model;
        $employee = $employee->paginate($rows);


        return response()->json([
            'employee' => $employee,
            'status' => 'Success',
        ]);
    }

    public function show(Request $request)
    {
        return response()->json([
            'employee' => Employee::where('id', $request->id)->first(),
            'status' => 'Success',
        ]);
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
            'email' => 'required',
            'basic_information' => 'required',
            'educational_background' => 'required',
            'additional_information' => 'required',
            'position' => 'required',
            'payroll_details' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $employee_id = Employee::select('id')->orderBy('id', 'desc')->first();

            if ($employee_id == null) {
                $new_id = "EMP_0001";
            } else {
                $count = explode('_', $employee_id['id']);
                $add_count = $count[1] + 1;
                if ($add_count < 10) { $new_id = "EMP_" . "000" . $add_count; } else { $new_id = "EMP_" . "00" . $add_count;}
            };

            $employee = Employee::create([
                'id' => $new_id,
                'email' => $request['email'],
                'basic_information' => $request['basic_information'],
                'educational_background' => $request['educational_background'],
                'additional_information' => $request['additional_information'],
                'position' => $request['position'],
                'payroll_details' => $request['payroll_details'],
            ]);

            return response()->json([
                'employee' => Employee::where('id', $employee->id)->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Created',
            ]);
        }
    }

    public function edit(Request $request)
    {
        return response()->json([
            'employee' => Employee::where('id', $request->id)->first(),
            'status' => 'Success',
        ]);
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
            'basic_information' => 'required',
            'educational_background' => 'required',
            'additional_information' => 'required',
            'position' => 'required',
            'payroll_details' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'basic_information' => array($request['basic_information']),
                'educational_background' => array($request['educational_background']),
                'additional_information' => array($request['additional_information']),
                'position' => array($request['position']),
                'payroll_details' => array($request['payroll_details']),
            ];

            $employee = Employee::where('id', $request['id'])->update($body);

            return response()->json([
                'employee' => Employee::where('id', $request['id'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }

    public function getNullUser()
    {
        $has_account = Employee::where('user_information', 'exists', false)->get();;
        if($has_account){
            return response()->json(['status'=>'result', 'message'=>$has_account]);
        }
        return response()->json(['status'=>'none', 'message'=>'No Data!']);
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
            $request_data = $request->all();
            $request_data['compensation']['effective_date'] = $request['effective_date'];

            $body = [
                'compensation' => array($request_data['compensation']),
            ];

            $employee = Employee::whereIn('id', $request['employees'])->update($body);

            return response()->json([
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }
}
