<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $user = Employee::where('email', $request->email)->first();

        Mail::send('forgot-password', ['user' => $user], function ($m) use ($user) {
            $m->from('ccolivera@caimitoapps.com', 'PIS');

            $m->to($user->email, $user->first_name . " " . $user->middle_name . " " . $user->last_name)->subject('Forgot Password!');
        });
    }
}
