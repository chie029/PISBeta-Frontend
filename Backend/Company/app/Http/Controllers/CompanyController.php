<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    public function index()
    {
        return Company::all();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'company_code' => 'required',
            'company_contact' => 'required',
            'company_address' => 'required',
            'company_archived' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $companyid = Company::select('company_id')->orderBy('company_id', 'desc')->first();

            if ($companyid == null) {
                $newid = "COMP_0001";
            } else {
                $count = explode('_', $companyid['company_id']);
                $addcount = $count[1] + 1;
                if ($addcount < 10) { $newid = "COMP_" . "000" . $addcount; } else { $newid = "COMP_" . "00" . $addcount; }
            };

            $company = Company::create([
                'company_id' => $newid,
                'company_name' => $request['company_name'],
                'company_code' => $request['company_code'],
                'company_contact' => $request['company_contact'],
                'company_address' => $request['company_address'],
                'company_archived' => $request['company_archived'],
            ]);

            return response()->json([
                'company' => Company::where('company_id', $company->company_id)->first(),
                'status' => 'success',
                'message' => 'Company Successfully Created',
            ]);
        }
    }

    public function update(Request $request, Company $company)
    {
        $body = [
            'company_name' => $request['company_name'],
            'company_code' => $request['company_code'],
            'company_contact' => $request['company_contact'],
            'company_address' => $request['company_address'],
            'company_archived' => $request['company_archived'],
        ];

        $company = Company::where('company_id', $request['company_id'])->update($body);

        return response()->json([
            'company' => Company::where('company_id', $request['company_id'])->first(),
            'status' => 'success',
            'message' => 'Company Successfully Updated',
        ]);
    }

    public function archived(Request $request, Company $company)
    {
        return response()->json([
            'company' => $company = Company::where('company_archived', '1')->get(),
            'status' => 'success',
            'message' => 'Company Successfully Archived',
        ]);
    }

    public function archive(Request $request, Company $company)
    {
        $body = ['company_archived' => $request['company_archived']];
        $company = Company::where('company_id', $request['company_id'])->update($body);

        return response()->json([
            'company' => Company::where('company_id', $request['company_id'])->first(),
            'status' => 'success',
            'message' => 'Company Successfully Updated',
        ]);
    }
}
