document.addEventListener('DOMContentLoaded', function () {
    const projectList = document.getElementById('project-list');
    const projectModal = document.getElementById('project-modal');
    const projectForm = document.getElementById('project-form');
    const createProjectBtn = document.getElementById('create-project-btn');
    const closeBtns = document.querySelectorAll('.close-btn');

    const taskModal = document.getElementById('task-modal');
    const taskForm = document.getElementById('task-form');
    const taskList = document.getElementById('task-list');
    const addTaskBtn = document.getElementById('add-task-btn');

    // Fetch Projects
    function fetchProjects() {
        fetch('/api/projects')
            .then(response => response.json())
            .then(projects => {
                projectList.innerHTML = '';
                projects.forEach(project => {
                    const li = document.createElement('li');
                    li.textContent = project.name;
                    li.addEventListener('click', () => {
                        window.location.href = `project-detail.html?id=${project.id}`;
                    });
                    projectList.appendChild(li);
                });
            });
    }

    // Create Project
    projectForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(projectForm);
        fetch('/api/projects', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(project => {
                fetchProjects();
                projectModal.style.display = 'none';
                projectForm.reset();
            });
    });

    // Fetch Tasks for a Specific Project
    function fetchTasks(projectId) {
        fetch(`/api/projects/${projectId}/tasks`)
            .then(response => response.json())
            .then(tasks => {
                taskList.innerHTML = '';
                tasks.forEach(task => {
                    const li = document.createElement('li');
                    li.textContent = `${task.name} - ${task.status}`;
                    li.addEventListener('click', () => {
                        // Add functionality to edit/delete task
                    });
                    taskList.appendChild(li);
                });
            });
    }

    // Create Task
    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const projectId = new URLSearchParams(window.location.search).get('id');
        const formData = new FormData(taskForm);
        fetch(`/api/projects/${projectId}/tasks`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(task => {
                fetchTasks(projectId);
                taskModal.style.display = 'none';
                taskForm.reset();
            });
    });

    // Show/Hide Modal
    createProjectBtn.addEventListener('click', () => {
        projectModal.style.display = 'block';
    });

    addTaskBtn.addEventListener('click', () => {
        taskModal.style.display = 'block';
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            projectModal.style.display = 'none';
            taskModal.style.display = 'none';
        });
    });

    // Initial Fetch
    if (projectList) {
        fetchProjects();
    }

    if (taskList) {
        const projectId = new URLSearchParams(window.location.search).get('id');
        fetchTasks(projectId);
    }
});
