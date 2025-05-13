# Product Management System

A comprehensive product management system built with Laravel and Bootstrap, featuring a user-friendly admin panel with authentication, product CRUD operations, and a RESTful API.

## Features

- **Admin Panel**: Clean and responsive Bootstrap-based interface
- **Authentication**: Secure login/logout functionality
- **Product Management**: Complete CRUD operations for products
- **Category Management**: Organize products by categories
- **RESTful API**: Full API support for all operations
- **Image Handling**: Support for both file uploads and base64 encoded images
- **Responsive Design**: Mobile-friendly interface

## Technologies Used

- **Backend**: Laravel 8
- **Frontend**: Bootstrap 5
- **Database**: MySQL
- **Authentication**: Laravel Sanctum for API authentication
- **CSS**: Bootstrap Icons for iconography

## Requirements

- PHP >= 7.4
- Composer
- MySQL or MariaDB
- Node.js and NPM (for frontend assets)

## Installation

Follow these steps to get the project up and running on your local machine:

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/ProductManagementSystem.git
cd ProductManagementSystem
```

### 2. Install dependencies

```bash
composer install
npm install
npm run dev
```

### 3. Configure environment variables

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file to set up your database connection:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_management
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run migrations and seeders

```bash
php artisan migrate
php artisan db:seed
```

### 5. Create storage link

```bash
php artisan storage:link
```

### 6. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## API Documentation

### Authentication

```
POST /api/login
```

Request body:
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

### Products

#### Get all products
```
GET /api/products
```

#### Get all products (including inactive)
```
GET /api/all-products
```

#### Get a specific product
```
GET /api/products/{id}
```

#### Create a product (requires authentication)
```
POST /api/products
```

Request body (multipart/form-data):
```
name: "Product Name"
description: "Product Description"
price: 99.99
category_id: 1
status: 1
image: [file upload]
```

OR with base64 image:
```json
{
  "name": "Product Name",
  "description": "Product Description",
  "price": 99.99,
  "category_id": 1,
  "status": 1,
  "image_base64": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcGBwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/..."
}
```

#### Update a product (requires authentication)
```
PUT /api/products/{id}
```

Request body (multipart/form-data or JSON with base64 image)

#### Delete a product (requires authentication)
```
DELETE /api/products/{id}
```

### Categories

#### Get all categories
```
GET /api/categories
```

#### Get a specific category
```
GET /api/categories/{id}
```

## Admin Panel

Access the admin panel at `http://localhost:8000/login` with the following credentials:

- Email: admin@example.com
- Password: password

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
