<?php

namespace App\Http\Controllers;

use App\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Deduction::where('archived', 0)->get();
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
            'name' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'code' => 'required',
            'deduction_type' => 'required',
            'payperiod' => 'required',
            'description' => 'required',
        ]);


        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $deduction_id = Deduction::select('deduction_id')->orderBy('deduction_id', 'desc')->first();

            if ($deduction_id == null) {
                $new_id = "DDT_0001";
            } else {
                $count = explode('_', $deduction_id['deduction_id']);
                $add_count = $count[1] + 1;
                if ($add_count < 10) { $new_id = "DDT_" . "000" . $add_count; } else { $new_id = "DDT_" . "00" . $add_count;}
            };

            $deduction = Deduction::insert([
                'deduction_id' => $new_id,
                'name' => $request['name'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable'], 
                'type' => $request['type'],
                'code' => $request['code'],
                'deduction_type' => $request['deduction_type'],
                'payperiod' => $request['payperiod'],
                'description' => $request['description'],
                'archived' => 0,
            ]);

            return response()->json([
                'deduction' => Deduction::where('deduction_id', $new_id)->first(),
                'status' => 'Success',
                'message' => 'Deduction Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'code' => 'required',
            'deduction_type' => 'required',
            'payperiod' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'name' => $request['name'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable'], 
                'type' => $request['type'],
                'code' => $request['code'],
                'deduction_type' => $request['deduction_type'],
                'payperiod' => $request['payperiod'],
                'description' => $request['description'],
            ];

            $deduction = Deduction::where('deduction_id', $request['deduction_id'])->update($body);

            return response()->json([
                'deduction' => Deduction::where('deduction_id', $request['deduction_id'])->first(),
                'status' => 'Success',
                'message' => 'Deduction Successfully Updated!',
            ]);
        }
    }

    public function archive(Request $request)
    {
        $body = ['archived' => 1];
        $deduction = Deduction::where('deduction_id', $request['deduction_id'])->update($body);
        return response()->json([
            'deduction' => Deduction::where('deduction_id', $request['deduction_id'])->first(),
            'status' => 'Success',
            'message' => 'Deduction Successfully Archived!',
        ]);
    }

    public function archived(Request $request)
    {
        return Deduction::where('archived', 1)->get();
    }
}
