<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display a listing of the tasks for a specific project
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $tasks = $project->tasks;
        return response()->json($tasks);
    }

    // Store a newly created task within a specific project
    public function store(Request $request, $projectId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in-progress,done',
        ]);

        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->create($validated);

        return response()->json($task, 201);
    }

    // Display the specified task within a specific project
    public function show($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        return response()->json($task);
    }

    // Update the specified task within a specific project
    public function update(Request $request, $projectId, $taskId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in-progress,done',
        ]);

        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        $task->update($validated);

        return response()->json($task);
    }

    // Remove the specified task from a specific project
    public function destroy($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        $task->delete();

        return response()->json(null, 204);
    }
}
