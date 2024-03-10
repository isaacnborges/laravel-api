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
- Create Student
    - URL: /api/students
    - Method: POST
    - Data Params:
        - name (string, required)
        - course (string, required)
        - email (string, required)
        - phone (string, required)

- Edit Student
    - URL: /api/students/{id}
    - Method: PUT
    - Data Params:
        - name (string, required)
        - course (string, required)
        - email (string, required)
        - phone (string, required)
        - Delete Student

    - URL: /api/students/{id}
    - Method: DELETE
    - Get Student by ID
    - URL: /api/students/{id}

- Method: GET
    - Get All Students
    - URL: /api/students
    - Method: GET
    - Query Params:
        - name (string, optional) - Filter by name
        - course (string, optional) - Filter by course
        - email (string, optional) - Filter by email
        - phone (string, optional) - Filter by phone
        - per_page (int, optional) - Number of records per page (default: 10)
        - page (int, optional) - Page number for pagination (default: 1)