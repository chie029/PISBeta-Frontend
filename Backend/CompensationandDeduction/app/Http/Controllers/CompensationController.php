<?php

namespace App\Http\Controllers;

use App\Compensation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompensationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Compensation::all();
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
            'taxable' => 'required', 
            'type' => 'required',
            'code' => 'required',
            'payperiod' => 'required',
            'deminimis' => 'required', 
            'prorated_absences' => 'required',
            'prorated_late' => 'required',
            'prorated_undertime' => 'required',
            'sss_computation' => 'required', 
            'thirteenth' => 'required',
        ]);


        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $compensationid = Compensation::select('compensation_id')->orderBy('compensation_id', 'desc')->first();

            if ($compensationid == null) {
                $newid = "CMP_0001";
            } else {
                $count = explode('_', $compensationid['compensation_id']);
                $addcount = $count[1] + 1;
                if ($addcount < 10) { $newid = "CMP_" . "000" . $addcount; } else { $newid = "CMP_" . "00" . $addcount;}
            };

            $compensation = Compensation::insert([
                'compensation_id' => $newid,
                'name' => $request['name'],
                'amount' => $request['amount'],
                'taxable' => $request['taxable'], 
                'type' => $request['type'],
                'code' => $request['code'],
                'payperiod' => $request['payperiod'],
                'deminimis' => $request['deminimis'], 
                'prorated_absences' => $request['prorated_absences'],
                'prorated_late' => $request['prorated_late'],
                'prorated_undertime' => $request['prorated_undertime'],
                'sss_computation' => $request['sss_computation'], 
                'thirteenth' => $request['thirteenth'],
            ]);

            return response()->json([
                'compensation' => Compensation::where('compensation_id', $newid)->first(),
                'status' => 'Success',
                'message' => 'Compensation Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compensation  $compensation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compensation $compensation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'taxable' => 'required', 
            'type' => 'required',
            'code' => 'required',
            'payperiod' => 'required',
            'deminimis' => 'required', 
            'prorated_absences' => 'required',
            'prorated_late' => 'required',
            'prorated_undertime' => 'required',
            'sss_computation' => 'required', 
            'thirteenth' => 'required',
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
                'payperiod' => $request['payperiod'],
                'deminimis' => $request['deminimis'], 
                'prorated_absences' => $request['prorated_absences'],
                'prorated_late' => $request['prorated_late'],
                'prorated_undertime' => $request['prorated_undertime'],
                'sss_computation' => $request['sss_computation'], 
                'thirteenth' => $request['thirteenth'],
            ];

            $compensation = Compensation::where('compensation_id', $request['compensation_id'])->update($body);

            return response()->json([
                'compensation' => Compensation::where('compensation_id', $request['compensation_id'])->first(),
                'status' => 'Success',
                'message' => 'Compensation Successfully Updated!',
            ]);
        }
    }
}
