<?php

namespace App\Http\Controllers\API;

use App\Mail\TaskDone;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {

        $id = $request->input('id');
        $project = Project::find($id);
        $tasks = null;
        if ($project) {
            $tasks = $project->tasks()->whereIsArchived(false)->get();
        }
        return $this->ParsedReturn($tasks, 'No task added yet!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return $this->ParsedReturn($task, 'Task has not been added, successfuly.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->ParsedReturn($task, 'Maybe you task has been removed.');
    }

    /**
     * Archive finished tasks
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function archive(Request $request) {
        $project_id = $request->input('project_id');
        $tasks = Task::whereProjectId($project_id)->whereIsFinished(true)->update([
            'is_archived' => true
        ]);
        return $this->ParsedReturn($tasks, 'Not archived!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if (!$task->is_finished && $request->input('is_finished')) {
            Mail::to('adil.rebah@avaliance.com')->send(new TaskDone($task->project->user, $task));
        }
        $task->update($request->all());
        return $this->ParsedReturn($task, 'Task unchanged!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        return $this->ParsedReturn($task->delete(), 'Task still alive.');
    }
}
