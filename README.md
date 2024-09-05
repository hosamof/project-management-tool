



Design Pattern:
This project uses the Repository pattern to abstract the data access layer for Projects and Tasks. This approach allows for cleaner, more maintainable code by separating concerns.
*Separation of Concerns*
Controllers: Handle HTTP requests, validate incoming data, and determine what action to take (e.g., create, update, delete). They serve as the bridge between the request data and the business logic.
Repositories: Handle data access and retrieval. They encapsulate the logic required to interact with the database, ensuring that the data access layer is separated from the rest of the application.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
