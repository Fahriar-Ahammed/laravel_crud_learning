# Laravel CRUD API for Notes and Users

## Project Description

This Laravel application provides a RESTful API for managing Notes and Users. It includes CRUD (Create, Read, Update, Delete) operations for both entities. The API is built following the Service Pattern with proper error handling and input validation. User image uploads are handled and stored in the public directory.

## Prerequisites

Before you begin, ensure you have the following installed:

-   **PHP:**  Version 8.1 or higher
-   **Composer:**  Dependency Manager for PHP
-   **Database:**  MySQL or any other database supported by Laravel
-   **Node.js & npm:** (Optional, if you plan to use frontend tooling like Laravel Mix/Vite, though not required for just the API backend)
-   **Postman or similar API testing tool:** For testing the API endpoints

## Installation

Follow these steps to set up the project locally:

1.  **Clone the repository (if applicable):**

    ```bash
    git clone [your-repository-url]
    cd laravel_crud_app
    ```

2.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure database settings:**

    ```bash
    cp .env.example .env
    ```

    Open the `.env` file and update the database credentials to match your local database setup:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

4.  **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

5.  **Run Database Migrations:**

    ```bash
    php artisan migrate
    ```

    This will create the `notes` and `users` tables in your database.

6.  **Set up storage link (for public disk access, if needed - not strictly required for this project as images are in `public`):**

    ```bash
    php artisan storage:link
    ```

7.  **Start the Laravel development server:**

    ```bash
    php artisan serve
    ```

    The API will be accessible at `http://localhost:8000/api`.

## API Endpoints

The API endpoints are structured for RESTful operations. Below are the details for each endpoint.

### Notes API (`/api/notes`)

#### 1. Get All Notes

-   **Endpoint:** `GET /api/notes`
-   **Description:** Retrieves a list of all notes.
-   **Request Headers:** `Content-Type: application/json` (optional)
-   **Response (Success - 200 OK):**

    ```json
    {
        "data": [
            {
                "id": 1,
                "title": "My First Note",
                "desc": "This is a test note.",
                "date": "2024-01-01",
                "status": "Pending",
                "created_at": "...",
                "updated_at": "..."
            },
            {
                "id": 2,
                "title": "Another Note",
                "desc": "Example note.",
                "date": "2024-01-10",
                "status": "Completed",
                "created_at": "...",
                "updated_at": "..."
            }
        ]
    }
    ```

#### 2. Create a New Note

-   **Endpoint:** `POST /api/notes`
-   **Description:** Creates a new note.
-   **Request Headers:** `Content-Type: application/json`
-   **Request Body (JSON Example):**

    ```json
    {
        "title": "New Note Title",
        "desc": "Note description here.",
        "date": "2024-02-20",
        "status": "Todo"
    }
    ```

-   **Response (Success - 201 Created):**

    ```json
    {
        "data": {
            "id": 3,
            "title": "New Note Title",
            "desc": "Note description here.",
            "date": "2024-02-20",
            "status": "Todo",
            "created_at": "...",
            "updated_at": "..."
        },
        "message": "Note created successfully"
    }
    ```

#### 3. Get Note by ID

-   **Endpoint:** `GET /api/notes/{id}`
-   **Description:** Retrieves a specific note by its ID.
-   **Request Headers:** `Content-Type: application/json` (optional)
-   **Path Parameter:** `{id}` - The ID of the note to retrieve.
-   **Response (Success - 200 OK):**

    ```json
    {
        "data": {
            "id": 1,
            "title": "My First Note",
            "desc": "This is a test note.",
            "date": "2024-01-01",
            "status": "Pending",
            "created_at": "...",
            "updated_at": "..."
        }
    }
    ```

#### 4. Update Note

-   **Endpoint:** `PUT /api/notes/{id}`
-   **Description:** Updates an existing note.
-   **Request Headers:** `Content-Type: application/json`
-   **Path Parameter:** `{id}` - The ID of the note to update.
-   **Request Body (JSON Example):**

    ```json
    {
        "title": "Updated Note Title",
        "desc": "Updated description.",
        "status": "In Progress"
    }
    ```

-   **Response (Success - 200 OK):**

    ```json
    {
        "data": {
            "id": 1,
            "title": "Updated Note Title",
            "desc": "Updated description.",
            "date": "2024-01-01",
            "status": "In Progress",
            "created_at": "...",
            "updated_at": "..."
        },
        "message": "Note updated successfully"
    }
    ```

#### 5. Delete Note

-   **Endpoint:** `DELETE /api/notes/{id}`
-   **Description:** Deletes a note.
-   **Path Parameter:** `{id}` - The ID of the note to delete.
-   **Response (Success - 200 OK):**

    ```json
    {
        "message": "Note deleted successfully"
    }
    ```

### Users API (`/api/users`)

#### 1. Get All Users

-   **Endpoint:** `GET /api/users`
-   **Description:** Retrieves a list of all users.
-   **Request Headers:** `Content-Type: application/json` (optional)
-   **Response (Success - 200 OK):**

    ```json
    {
        "data": [
            {
                "id": 1,
                "name": "John Doe",
                "email": "john.doe@example.com",
                "dob": "1990-01-01",
                "gender": "Male",
                "desc": "Test user.",
                "image": "images/users/...",
                "created_at": "...",
                "updated_at": "..."
            },
            // ... more users
        ]
    }
    ```

#### 2. Create a New User

-   **Endpoint:** `POST /api/users`
-   **Description:** Creates a new user. Handles image upload.
-   **Request Headers:** `Content-Type: multipart/form-data`
-   **Request Body (Form Data Example):**

    | Key     | Value                       | Type   |
        | :------ | :-------------------------- | :----- |
    | name    | John Doe                    | text   |
    | email   | john.doe@example.com        | text   |
    | dob     | 1990-01-01                  | text   |
    | gender  | Male                        | text   |
    | desc    | A brief description.        | text   |
    | image   | _Select an image file_     | file   |

-   **Response (Success - 201 Created):**

    ```json
    {
        "data": {
            "id": 2,
            "name": "John Doe",
            "email": "john.doe@example.com",
            "dob": "1990-01-01",
            "gender": "Male",
            "desc": "A brief description.",
            "image": "images/users/...",
            "created_at": "...",
            "updated_at": "..."
        },
        "message": "User created successfully"
    }
    ```

#### 3. Get User by ID

-   **Endpoint:** `GET /api/users/{id}`
-   **Description:** Retrieves a specific user by their ID.
-   **Request Headers:** `Content-Type: application/json` (optional)
-   **Path Parameter:** `{id}` - The ID of the user to retrieve.
-   **Response (Success - 200 OK):**

    ```json
    {
        "data": {
            "id": 1,
            "name": "John Doe",
            "email": "john.doe@example.com",
            "dob": "1990-01-01",
            "gender": "Male",
            "desc": "Test user.",
            "image": "images/users/...",
            "created_at": "...",
            "updated_at": "..."
        }
    }
    ```

#### 4. Update User

-   **Endpoint:** `POST /api/users/{id}` (Using POST to handle `multipart/form-data` easily for image updates)
-   **Description:** Updates an existing user. Can update user details and/or image.
-   **Request Headers:** `Content-Type: multipart/form-data`
-   **Path Parameter:** `{id}` - The ID of the user to update.
-   **Request Body (Form Data Example - updating name and image):**

    | Key     | Value                       | Type   |
        | :------ | :-------------------------- | :----- |
    | name    | Updated User Name           | text   |
    | email   | (leave unchanged or update) | text   |
    | dob     | (leave unchanged or update) | text   |
    | gender  | (leave unchanged or update) | text   |
    | desc    | (leave unchanged or update) | text   |
    | image   | _Select a new image file (optional)_ | file   |
    | _method_ | PUT                         | text   |  **(Important for some clients)**

    **Note:** Some API testing tools or clients might require you to send `_method: PUT` in the form data to properly simulate a PUT request when using `multipart/form-data`. However, in this setup, we are directly handling POST requests for updates in the route definition to simplify file uploads with `multipart/form-data`.

-   **Response (Success - 200 OK):**

    ```json
    {
        "data": {
            "id": 1,
            "name": "Updated User Name",
            "email": "john.doe@example.com",
            "dob": "1990-01-01",
            "gender": "Male",
            "desc": "Updated description.",
            "image": "images/users/...",
            "created_at": "...",
            "updated_at": "..."
        },
        "message": "User updated successfully"
    }
    ```

#### 5. Delete User

-   **Endpoint:** `DELETE /api/users/{id}`
-   **Description:** Deletes a user.
-   **Path Parameter:** `{id}` - The ID of the user to delete.
-   **Response (Success - 200 OK):**

    ```json
    {
        "message": "User deleted successfully"
    }
    ```

## Error Handling

The API uses standard HTTP status codes to indicate the outcome of requests. Common error responses include:

-   **404 Not Found:** When a requested resource (e.g., note or user with a specific ID) is not found.
-   **422 Unprocessable Entity:**  For validation errors. The response body will typically contain details about the validation failures.
-   **500 Internal Server Error:** For unexpected server errors. Check the Laravel logs (`storage/logs/laravel.log`) for detailed error information.

Example of a Validation Error (422) response when creating a Note with a missing title:

```json
{
    "message": "The title field is required.",
    "errors": {
        "title": [
            "The title field is required."
        ]
    }
}
