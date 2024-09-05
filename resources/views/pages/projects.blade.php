<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1>Projects</h1>
                        <hr />
                        <ul id="project-list"></ul>
                    </div>

                    <div id="project-modal" class="modal">
                        <div class="modal-content">
                            <span class="close-btn">&times;</span>
                            <h2>Create Project</h2>
                            <form id="project-form">
                                @csrf <!-- This generates the hidden input field for the CSRF token -->
                                <label for="project-name">Project Name:</label>
                                <input type="text" id="project-name" name="name" required>
                                <label for="project-description">Description:</label>
                                <textarea id="project-description" name="description"></textarea>
                                <button type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <button id="create-project-btn">Create New Project</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>