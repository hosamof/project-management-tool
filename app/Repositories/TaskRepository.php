<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getAllTasks($projectId)
    {
        return $this->task->where('project_id', $projectId)->get();
    }

    public function findTaskById($id)
    {
        return $this->task->find($id);
    }

    public function createTask($data)
    {
        return $this->task->create($data);
    }

    public function updateTask($id, $data)
    {
        $task = $this->findTaskById($id);
        return $task->update($data);
    }

    public function deleteTask($id)
    {
        $task = $this->findTaskById($id);
        return $task->delete();
    }
}
