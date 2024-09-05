document.addEventListener('DOMContentLoaded', function () {
    const projectList = document.getElementById('project-list');
    const projectForm = document.getElementById('project-form');
    const createProjectBtn = document.getElementById('create-project-btn');
    const closeBtns = document.querySelectorAll('.close-btn');

    const taskForm = document.getElementById('task-form');
    const taskList = document.getElementById('task-list');
    const addTaskBtn = document.getElementById('add-task-btn');

    // Fetch Projects
    function fetchProjects() {
        const options = {
            method: 'GET',
            headers: { 'content-type': 'application/json' },
            mode: 'no-cors'
        };
        fetch('api/projects', options)
            .then(response => response.json())
            .then(projects => {
                projectList.innerHTML = '';
                projects.forEach(project => {
                    const li = document.createElement('li');
                    li.textContent = project.name;
                    li.addEventListener('click', () => {
                        window.location.href = `project-detail?id=${project.id}`;
                    });
                    projectList.appendChild(li);
                });
            });
    }

    // Create Project
    projectForm?.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(projectForm);
        fetch('api/projects', {
            method: 'POST',
            // headers: {
            //     'Content-Type': 'application/json',
            //     'X-CSRF-TOKEN': getCsrfToken() // Add CSRF token here
            // },
            mode: 'no-cors',
            body: formData
        })
            .then(response => response.json())
            .then(project => {
                fetchProjects();
                const projectModal = document.getElementById('project-modal');
                projectModal.style.display = 'none';
                projectForm.reset();
            });
    });

    // Fetch Tasks for a Specific Project
    function fetchTasks(projectId) {
        fetch(`api/projects/${projectId}/tasks`)
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
    taskForm?.addEventListener('submit', function (e) {
        e.preventDefault();
        const projectId = new URLSearchParams(window.location.search).get('id');
        const formData = new FormData(taskForm);
        formData.append("project_id", projectId)
        fetch(`api/projects/${projectId}/tasks`, {
            method: 'POST',
            // headers: {
            //     'Content-Type': 'application/json',
            //     'X-CSRF-TOKEN': getCsrfToken() // Add CSRF token here
            // },
            body: formData,
            mode: 'no-cors'
        })
            .then(response => response.json())
            .then(task => {
                fetchTasks(projectId);
                const taskModal = document.getElementById('task-modal');
                taskModal.style.display = 'none';
                taskForm.reset();
            });
    });

    // Show/Hide Modal
    createProjectBtn?.addEventListener('click', () => {
        const projectModal = document.getElementById('project-modal');
        projectModal.style.display = 'block';
    });

    addTaskBtn?.addEventListener('click', () => {
        const taskModal = document.getElementById('task-modal');
        taskModal.style.display = 'block';
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const projectModal = document.getElementById('project-modal');
            projectModal && (projectModal.style.display = 'none')
            const taskModal = document.getElementById('task-modal');
            taskModal && (taskModal.style.display = 'none')
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

// // Function to get CSRF token from meta tag
// function getCsrfToken() {
//     return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// }