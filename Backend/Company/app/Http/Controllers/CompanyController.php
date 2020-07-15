<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    public function index(Request $request)
    {
        $company_model = new Company();
        $company_index = $company_model->where('isArchived', 0);
        $company = [];
        $error = [];

        $rows = $request->get('show') ? (int)$request->get('show') : 10;

        // Search
        if($request->has('search')) $company = $company_index->search($request->get('search'));

        // Sorting
        if(!empty($request->get('sort_in')) && !empty($request->get('sort_by')))  $company = $company_index->sorting($request->sort_in, $request->sort_by);

        // Paginate
        if ($company == null) $company = $company_index;
        $company = $company->paginate($rows);

        return apiReturn($company, 'Success', 'success');
    }

    public function show($id)
    {
        $company = Company::where('id', $id)->first();
        return apiReturn($company, 'Success', 'success');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'created_by' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'failed', 'result' => $validator->errors()]);
        } else {
            $company_id = Company::select('id')->orderBy('id', 'desc')->first();

            if ($company_id == null) {
                $new_id = "COMP_0001";
            } else {
                $count = explode('_', $company_id['id']);
                $add_count = $count[1] + 1;
                if ($add_count < 10) { $new_id = "COMP_" . "000" . $add_count; } else { $new_id = "COMP_" . "00" . $add_count; }
            };

            $company = Company::create([
                'id' => $new_id,
                'name' => $request['name'],
                'code' => $request['code'],
                'contact' => $request['contact'],
                'address' => $request['address'],
                'isArchived' => 0,
                'created_by' => $request['created_by'],
            ]);

            return response()->json([
                'status' => 'success',
                'result' => 'Company Successfully Created',
            ]);
        }
    }

    public function edit(Request $request)
    {
        $company = Company::where('id', $request->get('id'))->first();
        return apiReturn($company, 'Success', 'success');
    }

    public function update(Request $request, Company $company)
    {
        $body = [
            'name' => $request['name'],
            'code' => $request['code'],
            'contact' => $request['contact'],
            'address' => $request['address'],
        ];

        $company = Company::where('id', $request['id'])->update($body);

        if ($company) {
            return response()->json([
                'company' => Company::where('id', $request['id'])->first(),
                'status' => 'success',
                'message' => 'Company Successfully Updated',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Company Failed to Update',
        ]);
    }

    public function archived(Request $request, Company $company)
    {
        return response()->json([
            'company' => $company = Company::where('isArchived', '1')->get(),
            'status' => 'success',
            'message' => 'Company Successfully Archived',
        ]);
    }

    public function archive(Request $request, Company $company)
    {
        $body = ['isArchived' => $request['isArchived']];
        $company = Company::where('company_id', $request['company_id'])->update($body);

        return response()->json([
            'company' => Company::where('company_id', $request['company_id'])->first(),
            'status' => 'success',
            'message' => 'Company Successfully Updated',
        ]);
    }
}
