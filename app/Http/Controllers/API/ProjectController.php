<?php

namespace App\Http\Controllers\API;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->header('UserId') ?? $request->input('id');
        $user = User::find($id);
        $projects = null;
        if ($user) {
            $projects = $user->projects;
        }
        return $this->ParsedReturn($projects, 'No project added yet!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->header('UserId') ?? $request->input('id');
        $data = $request->all();
        $data['user_id'] = $id;
        $project = Project::create($data);
        return $this->ParsedReturn($project, 'Project has not been added, successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->tasks;
        return $this->ParsedReturn($project, 'Your project is gone.');
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
        $project->update($request->all());
        return $this->ParsedReturn($project, 'Project unchanged!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return $this->ParsedReturn($project->delete(), 'Project has not been deleted, successfuly.');
    }
}
