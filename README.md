# Pastry Shop API
This API is designed to manage orders, products, and clients for a pastry shop. The project is built using Lumen, PHP, PostgreSQL, and Docker. Below are the steps to get the project up and running.

## Prerequisites
- Docker
- Docker Compose
- PostgreSQL
- PgAdmin (optional but recommended)

## Setup
1. **Copy the .env file**

Copy the example environment configuration file .env.example to .env. This file contains configuration variables such as database credentials, app key, and other project settings.

```bash
cp .env.example .env
```

2. **Generate JWT Secret**

After setting up the .env file, generate a new JWT secret key by running the following command:

```bash
php artisan jwt:secret
```

This command generates a secret key used by the JWT (JSON Web Token) package to sign tokens for user authentication. This key will be stored in the `.env` file as `JWT_SECRET`.

## Database Setup
### Create the database using PgAdmin
To create the `pastry` database using `PgAdmin`:

1. **Open PgAdmin in your browser by navigating to `http://localhost:5050`.**
2. **Log in using the credentials set in your `docker-compose.yml`.**
3. **Right-click on "Databases", choose "Create", and fill in the necessary information to create a new database called `pastry`.**

    Important: If PgAdmin doesn't start, ensure that the directory `.docker/pgadmin` contains two subdirectories: `session` and `storage`.

```bash
mkdir -p .docker/pgadmin/session .docker/pgadmin/storage
```

### Run Migrations and Seeds
Once your database is ready, execute the following commands to run the database migrations and seed data:

```bash
php artisan migrate
php artisan db:seed
```

These commands will set up the necessary tables and insert any initial data specified in the seeder files.

## Symbolic Link Setup for File Uploads
To enable file uploads, you must create a symbolic link between your storage folder and public directory:

```bash
mkdir -p storage/app/public
ln -s $(pwd)/storage/app/public $(pwd)/public/storage
```

This will allow uploaded files to be publicly accessible via the `public/storage` URL.

## Authentication and Login Route
To log in and obtain a Bearer Access Token, use the `/login` route with a POST request. The route expects a JSON body containing valid credentials. Upon success, it will return a JWT token.

### Example request
```bash
POST /login
{
    "email": "user@example.com",
    "password": "password123"
}
```

### Example response
```json
{
  "access_token": "your_jwt_token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

Use this token to authenticate subsequent API requests by including the **Bearer Token** in the `Authorization` header.

```bash
Authorization: Bearer your_jwt_token
```

## Other Routes
Once authenticated, you can interact with various API routes, such as:

- /products: List, create, update, and delete products.
- /orders: List, create, and update orders.
- /clients: Manage client data.
Make sure to pass the **Bearer Token** in the `Authorization` header for all requests that require authentication.

## Running Tests
To run the unit tests:

```bash
vendor/bin/phpunit
```

The test suite includes various tests for models and controllers, ensuring the correct functionality of the API.
