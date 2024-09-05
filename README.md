# Project Management Tool

## Overview
A basic project management tool that allows users to create, update, delete, and manage projects and tasks. Developed using Laravel with Blade and Ajax for the frontend.

## Features
- Manage Projects (CRUD)
- Manage Tasks within Projects (CRUD)
- Basic authentication using Laravel's built-in system
- Blade templating engine for frontend views
- Repository pattern to abstract data access

### ---------------------------------------------------------- ###

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/hosamof/project-management-tool.git
cd project-management-tool
```

### 2. Install Dependencies
composer install
npm install


### 3. Setup Environment
- Copy .env.example to .env
- Configure your database and other settings in .env
- Generate application key:
```bash
php artisan key:generate
```

### 4. Run Migrations
```bash
php artisan migrate
```

### 5. Start the Server
```bash
php artisan serve
```

### ---------------------------------------------------------- ###

## Design Pattern:
- This project uses the Repository pattern to abstract the data access layer for Projects and Tasks. This approach allows for cleaner, more maintainable code by separating concerns.
### Separation of Concerns
- Controllers: Handle HTTP requests, validate incoming data, and determine what action to take (e.g., create, update, delete). They serve as the bridge between the request data and the business logic.
- Repositories: Handle data access and retrieval. They encapsulate the logic required to interact with the database, ensuring that the data access layer is separated from the rest of the application.

## Future Improvements
- Implement Update and Delete for Projects and tasks
- Advanced search and filtering.
- User roles and permissions.
- Real-time updates using WebSockets.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
