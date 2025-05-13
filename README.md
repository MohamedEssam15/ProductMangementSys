# Product Management System

A comprehensive product management system built with Laravel and Bootstrap, featuring a user-friendly admin panel with authentication, product CRUD operations, and a RESTful API.

## Features

- **Admin Panel**: Clean and responsive Bootstrap-based interface
- **Authentication**: Secure login/logout functionality
- **Product Management**: Complete CRUD operations for products
- **RESTful API**: Full API support for all operations
- **Image Handling**: Support file uploads
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

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
