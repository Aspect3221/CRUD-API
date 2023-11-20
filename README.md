# CRUD-API

### Prerequisites
- Docker
- Composer

## Getting Started
- After cloning, cd into the root of the project and run ```docker-compose up -d```
- Once the docker containers are up run ```docker-compose exec app``` and run the following commands: <br/>
```bash
$ composer install
$ php artisan key:generate
$ php artisan storage:link
$ chmod -R 777 storage bootstrap/cache
$ php artisan migrate
$ php artisan db:seed
```

## How to get api token
- **Method:** POST
- **Endpoint:** `http://localhost/api/login`
- **Parameters:** <br />
    name: Admin,<br/>
    email: admin@example.com,<br />
    password: 123456789,<br />
    password_confirmation: 123456789.
- **Description:** Will return the bearer token which you can then use for other calls below.

## API Endpoints


### 1. Add a New Book
- **Method:** POST
- **Endpoint:** `http://localhost/api/books`
- **Description:** Add a new book to the database.

### 2. Retrieve All Books
- **Method:** GET
- **Endpoint:** `http://localhost/api/books`
- **Description:** Retrieve a list of all books.

### 3. Retrieve a Book by ID
- **Method:** GET
- **Endpoint:** `http://localhost/api/books/{id}`
- **Description:** Retrieve a book by its ID.

### 4. Update Book Details
- **Method:** PUT
- **Endpoint:** `http://localhost/books/{id}`
- **Description:** Update the details of a specific book.

### 5. Delete a Book
- **Method:** DELETE
- **Endpoint:** `http://localhost/books/{id}`
- **Description:** Delete a book from the database.





