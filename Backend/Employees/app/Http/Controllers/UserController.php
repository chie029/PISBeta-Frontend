<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //
        public function authenticate(Request $request)
        {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (password_verify($request->password, $user->password)) {
                    $credentials = $request->only('email', 'password');
                    try {
                        if (!$token = JWTAuth::attempt($credentials)) {
                            return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                    } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }
                    $user = [ 'user' => JWTAuth::user(), 'token' => $token ];
                    return response()->json(['status' => 'success','result' => $user]);
                } else {
                    return response()->json(['status' => 'failed','result' => 'Incorrect Password!']);
                }
            } else {
                return response()->json(['status' => 'failed','result' => 'Invalid Email!']);
            }
        }
        

        public function createAccount(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:3',
                'role' => 'required',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $body = [
                'hasAccount' => 1,
                'password' => Hash::make($request['password']),
                'role' => $request['role'],
            ];

            $user = User::where('id', $request['id'])->update($body);

            return response()->json(['status' => 'success', 'result' => User::where('id', $request['id'])->first()]);
        }


        public function getUserAuth()
        {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json(['status' => 'success', 'result' => compact('user')]);
        }

        public function logout(Request $request) {

            JWTAuth::invalidate($request->token);

            return response()->json([
                'status' => 'success',
                'result' => 'logout'
            ], 200);
        }
}
