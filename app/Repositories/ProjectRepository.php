<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getAllProjects()
    {
        return $this->project->all();
    }

    public function findProjectById($id)
    {
        return $this->project->find($id);
    }

    public function createProject($data)
    {
        return $this->project->create($data);
    }

    public function updateProject($id, $data)
    {
        $project = $this->findProjectById($id);
        return $project->update($data);
    }

    public function deleteProject($id)
    {
        $project = $this->findProjectById($id);
        return $project->delete();
    }
}
