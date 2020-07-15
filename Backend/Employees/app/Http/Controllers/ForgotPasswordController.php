<?php

namespace App\Http\Controllers;

use Str;
use Hash;
use App\Employee;
use App\AccessCode;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $user = Employee::where('employee_basic_information.email', $request->email)->first();
            if ($user) {
                $access_code = Str::random(15);
                $user_account = $user->employee_basic_information[0];

                AccessCode::insert([
                    'code' => $access_code,
                    'employee' => $request->email,
                    'status' => 1
                ]);

                Mail::send('forgot-password', ['user' => $user_account, 'accessCode' => $access_code], function ($m) use ($user_account) {
                    $m->from('ccolivera@caimitoapps.com', 'PIS');
                    $m->to($user_account['email'], $user_account['first_name'] . " " . $user_account['middle_name'] . " " . $user_account['last_name'])->subject('Forgot Password!');
                });

                return response()->json(['status' => 'Success', 'message' => 'Email Sent']);
            } else {
                return response()->json(['status' => 'Failed', 'message' => 'Invalid Email']);
            }
        }
    }

    public function checkCode(Request $request)
    {
        $code_check = AccessCode::where(['code' => $request->code, 'employee' => $request->email, 'status' => 1])->first();
        if ($code_check) {
            return response()->json(['status' => 'Success', 'message' => 'Code Confirmed']);
        } else {
            $code_check_status = AccessCode::where(['code' => $request->code, 'employee' => $request->email, 'status' => 0])->first();
            if ($code_check_status) {
                return response()->json(['status' => 'Success', 'message' => 'Code Expired']);
            } else {
                return response()->json(['status' => 'Failed', 'message' => 'Invalid Code']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $request_data = $request->all();
            $request_data['employee_user_information']['password'] = Hash::make($request['password']);

            $body = ['employee_user_information' => $request_data['employee_user_information']];
            $code = ['status' => 0];

            Employee::where('employee_basic_information.email', $request['email'])->update($body);
            AccessCode::where('employee_basic_information.email', $request['email'])->update($body);
            return response()->json([
                'employee' => Employee::where('employee_basic_information.email', $request['email'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }
}
