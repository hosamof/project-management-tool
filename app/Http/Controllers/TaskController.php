<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index($projectId)
    {
        $tasks = $this->taskRepository->getAllTasks($projectId);
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in-progress,done',
        ]);
        $task = $this->taskRepository->createTask($validatedData);
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = $this->taskRepository->findTaskById($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:todo,in-progress,done',
        ]);

        $task = $this->taskRepository->updateTask($id, $validatedData);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = $this->taskRepository->deleteTask($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(null, 204);
    }
}
