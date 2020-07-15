<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
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
            'project_name' => 'required',
            'project_lead' => 'required',
            'project_description' => 'required',
            'date_start' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed', 'message' => $validator->errors()]);
        } else {
            $project_id = Project::select('project_id')->orderBy('project_id', 'desc')->first();

            if ($project_id == null) {
                $new_id = "PROJ_0001";
            } else {
                $count = explode('_', $project_id['project_id']);
                $add_count = $count[1] + 1;
                if ($add_count < 10) { $new_id = "PROJ_" . "000" . $add_count; } else { $new_id = "PROJ_" . "00" . $add_count;}
            };

            $project = Project::create([
                'project_id' => $new_id,
                'project_name' => $request['project_name'],
                'project_lead' => $request['project_lead'],
                'project_description' => $request['project_description'],
                'created_by' => $request['created_by'],
                'date_start' => $request['date_start'],
                'date_end' => $request['date_end'],
                'deleted_by' => $request['deleted_by']
            ]);

            return response()->json([
                'project' => Project::where('project_id', $project->project_id)->first(),
                'status' => 'Success',
                'message' => 'Project Successfully Created',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_lead' => 'required',
            'project_description' => 'required',
            'date_start' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => 'Failed','message' => $validator->errors()]);
        } else {
            $body = [
                'project_name' => $request['project_name'],
                'project_lead' => $request['project_lead'],
                'project_description' => $request['project_description'],
                'date_start' => $request['date_start'],
                'date_end' => $request['date_end'],
            ];

            $project = Project::where('project_id', $request['project_id'])->update($body);

            return response()->json([
                'project' => Project::where('project_id', $request['project_id'])->first(),
                'status' => 'Success',
                'message' => 'Project Successfully Updated!',
            ]);
        }
    }
}
