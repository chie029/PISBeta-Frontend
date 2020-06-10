<?php

namespace App\Http\Controllers;

use Hash;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
            'employee_user_information' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {

            $requestData = $request->all();
            $requestData['employee_user_information']['password'] = Hash::make($request['password']);

            $body = [
                'employee_user_information' => $requestData['employee_user_information'],
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
            $email = Employee::where('employee_basic_information.email', $request->email)->first();
            if ($email) {
                $user = Employee::where(['employee_basic_information.email' => $request->email, 'employee_user_information.has_account' => '1'])->first();
                if($user) {
                    if(password_verify($request->password, $user->employee_user_information['password'])) {
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

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
            'confirm_epassword'=>'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {

            $requestData = $request->all();
            $requestData['employee_user_information']['password'] = Hash::make($request['password']);

            $body = [
                'employee_user_information' => $requestData['employee_user_information'],
            ];

            $employee = Employee::where('employee_basic_information.email', $request['email'])->update($body);

            return response()->json([
                'employee' => Employee::where('employee_basic_information.email', $request['email'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }
}
