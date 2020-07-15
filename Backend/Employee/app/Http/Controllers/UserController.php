<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        return $this->respondWithToken($token);

        $employee = new Employee();

        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['message' => $validator->messages()]);
        } else {

            $user = Employee::where('basic_information.email', $request->email)->first();
            if (!$user) {
                return response()->json(['result'=>'Failed', 'message' => 'Invalid Email!']);
            }

            $no_account = Employee::where('user_information', 'exists', false)->first();
            if($no_account){
                return response()->json(['result'=>'Failed', 'message' => 'User not Registered!']);
            }

            $token = $user['id'] . $user->basic_information[0]['email'];
            return encrypt($token);

            if(password_verify($request->password, $user->user_information['password'])) {
                return response()->json(['user' => $user, 'result' => 'Success', 'message' => 'Successfully Login!']);
            } else {
                return response()->json(['result' => 'Failed', 'message' => 'Invalid Password!']);
            }
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {

            $body = [
                'hasAccount' => 1,
                'password' => Hash::make($request['password']),
                'role' => $request['role'],
            ];

            $employee = Employee::where('id', $request['id'])->update($body);

            return response()->json([
                'user' => Employee::first(),
                'status' => 'Success',
                'message' => 'User Successfully Updated!',
            ]);
    }

    public function getUsers()
    {
        $has_account = Employee::where('user_information', 'exists', true)->get();

        if($has_account){
            return response()->json(['result' => $has_account, 'status' => 'Success']);
        }
        return response()->json(['result' => 'No Data!', 'status'=>'Success']);
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

            $request_data = $request->all();
            $request_data['user_information']['password'] = Hash::make($request['password']);

            $body = [
                'user_information' => $request_data['user_information'],
            ];

            $employee = Employee::where('basic_information.email', $request['email'])->update($body);

            return response()->json([
                'employee' => Employee::where('basic_information.email', $request['email'])->first(),
                'status' => 'Success',
                'message' => 'Employee Successfully Updated!',
            ]);
        }
    }
}
