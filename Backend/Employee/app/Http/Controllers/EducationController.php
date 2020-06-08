<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Education::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), ['employee_id' => 'required']);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {

            $education = Education::create([
                'employee_id' => $request['employee_id'],
                'educational_background' => $request['educational_background'],
            ]);

            return response()->json([
                'education' => Education::where('employee_id ', $education->employee_id)->first(),
                'status' => 'Success',
                'message' => 'Department Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        //
    }
}
