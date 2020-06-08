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
            'employee_code' => 'required',
            'first_name' => 'required', 
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'citizenship' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'present_address' => 'required',
            'province_address' => 'required',
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
                'employee_code' => $request['employee_code'],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'suffix_name' => $request['suffix_name'],
                'email' => $request['email'],
                'personal_email' => $request['personal_email'],
                'mobile_no' => $request['mobile_no'],
                'gender' => $request['gender'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'religion' => $request['religion'],
                'marital_status' => $request['marital_status'],
                'citizenship' => $request['citizenship'],
                'birth_date' => $request['birth_date'],
                'birth_place' => $request['birth_place'],
                'present_address' => $request['present_address'],
                'province_address' => $request['province_address'],
                'image' => $request['image'],
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
    public function updateBasicInfo(Request $request, Employee $employee)
    {

        $validator = Validator::make($request->all(), [
                'employee_code' => $request['employee_code'],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'suffix_name' => $request['suffix_name'],
                'email' => $request['email'],
                'personal_email' => $request['personal_email'],
                'mobile_no' => $request['mobile_no'],
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'employee_code' => $request['employee_code'],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'suffix_name' => $request['suffix_name'],
                'email' => $request['email'],
                'personal_email' => $request['personal_email'],
                'mobile_no' => $request['mobile_no'],
            ];

            $employee = Employee::where('employee_id', $request['employee_id'])->update($body);

            return response()->json([
                'employee' => Employee::where('employee_id', $request['employee_id'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
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
    public function updateAdditionalInfo(Request $request, Employee $employee)
    {

        $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'citizenship' => 'required',
            'birth_date' => 'required',
            'bitrth_place' => 'required',
            'present_address' => 'required',
            'province_address' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'gender' => $request['gender'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'religion' => $request['religion'],
                'marital_status' => $request['marital_status'],
                'citizenship' => $request['citizenship'],
                'birth_date' => $request['birth_date'],
                'bitrth_place' => $request['bitrth_place'],
                'present_address' => $request['present_address'],
                'province_address' => $request['province_address'],
            ];

            $employee = Employee::where('employee_id', $request['employee_id'])->update($body);

            return response()->json([
                'employee' => Employee::where('employee_id', $request['employee_id'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
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
    public function createUser(Request $request, Employee $employee)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'password' => Hash::make($request['password']),
                'role' => $request['role'],
                'has_account' => 1,
            ];

            $employee = Employee::where('employee_id', $request['employee_id'])->update($body);

            return response()->json([
                'employee' => Employee::where('employee_id', $request['employee_id'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['message' => $validator->messages()]);
        } else {
            $email = Employee::where('email', $request->email)->first();
            if ($email) {
                $user = Employee::where(['email' => $request->email, 'has_account' => 1])->first();
                if($user) {
                    if(password_verify($request->password, $user->password)) {
                        return response()->json(['user' => $user, 'result'=>'Success', 'message' => 'Successfully Login!']);
                    } else {
                        return response()->json(['result'=>'Failed', 'message' => 'Invalid Password!']);
                    }
                } else {
                    return response()->json(['result'=>'Failed', 'message' => 'User not registered!']);
                }
            } else {
                return response()->json(['result'=>'Failed', 'message' => 'Invalid Email!']);
            } 
        }
    }
}
