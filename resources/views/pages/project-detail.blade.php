<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name}}
        </h2>
        <br>
        <p id="project-description">{{ $project->description}}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1>Task List</h1>
                        <hr>
                        <ul id="task-list"></ul>
                    </div>

                    <div id="task-modal" class="modal">
                        <div class="modal-content">
                            <span class="close-btn">&times;</span>
                            <h2>Create Task</h2>
                            <form id="task-form">
                                @csrf <!-- This generates the hidden input field for the CSRF token -->
                                <label for="task-name">Task Name:</label>
                                <input type="text" id="task-name" name="name" required>
                                <label for="task-description">Description:</label>
                                <textarea id="task-description" name="description"></textarea>
                                <label for="task-status">Status:</label>
                                <select id="task-status" name="status" required>
                                    <option value="todo">To Do</option>
                                    <option value="in-progress">In Progress</option>
                                    <option value="done">Done</option>
                                </select>
                                <button type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <button id="add-task-btn">Add Task</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>