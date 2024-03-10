# laravel-api

This Laravel API provides CRUD operations for managing student records.

## Requirements

- PHP version: >= 8.1
- Laravel version: >= 10.10

### Install dependencies:
```
composer install
```

### Run migrations:
```
php artisan migrate
```

### Start the development server:
```
php artisan serve
```

### Endpoints

#### Auth
- Login
    - URL: /api/login
    - Method: Post
    - Data Params:
        - email (string, required)
        - password (string, required)
- Logout
    - URL: /api/students/{id}
    - Method: Post
    - Data Params:
        - email (string, required)
        - password (string, required)
#### Users
- Store
    - URL: /api/users
    - Method: Post
    - Data Params:
        - name (string, required)
        - email (string, required)
        - password (string, required)
- Update  - Auth Required
    - URL: /api/users/{id}
    - Method: Put
    - Data Params:
        - name (string, required)
        - email (string, required)
        - password (string, required)
- Destroy - Auth Required
    - URL: /api/users/{id}
    - Method: Delete
- Show
    - URL: /api/students/{id}
    - Method: Get
- Index
    - URL: /api/users
    - Method: Get
    - Query Params:
        - name (string, optional) - Filter by name
        - course (string, optional) - Filter by course
        - email (string, optional) - Filter by email
        - phone (string, optional) - Filter by phone
        - per_page (int, optional) - Number of records per page (default: 10)
        - page (int, optional) - Page number for pagination (default: 1)
#### Students
- Create - Auth Required
    - URL: /api/students
    - Method: Post
    - Data Params:
        - name (string, required)
        - course (string, required)
        - email (string, required)
        - phone (string, required)
- Update - Auth Required
    - URL: /api/students/{id}
    - Method: Put
    - Data Params:
        - name (string, required)
        - course (string, required)
        - email (string, required)
        - phone (string, required)
- Delete - Auth Required
    - URL: /api/students/{id}
    - Method: Delete
- Get by ID
    - URL: /api/students/{id}
    - Method: Get
- Get All
    - URL: /api/students
    - Method: Get
    - Query Params:
        - name (string, optional) - Filter by name
        - course (string, optional) - Filter by course
        - email (string, optional) - Filter by email
        - phone (string, optional) - Filter by phone
        - per_page (int, optional) - Number of records per page (default: 10)
        - page (int, optional) - Page number for pagination (default: 1)

#### Samples documentation
- Postman
    - Open [docs](./docs/) folder, inside has a [postman](https://www.postman.com/) collection that could be used for test

#### Considerations and Future Improvements
Api documentation with Swagger that allows to describe, document, and test the Api.

These are potential enhancements to consider for the future, depending on your application's evolving requirements and usage patterns. Each improvement can contribute to a better-performing and more maintainable system.