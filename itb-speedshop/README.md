# ITB Speedshop - Web E-Commerce Platform

ITB Speedshop is a professional e-commerce web application developed as part of a Cloud Computing project. The platform provides a comprehensive solution for online commerce, featuring a robust backend built with Laravel and a modern, responsive frontend using Tailwind CSS and Alpine.js.

## Overview

The objective of this project is to implement a scalable and secure e-commerce environment that demonstrates best practices in web development and cloud-native architectures. ITB Speedshop enables users to browse products, manage shopping carts, and complete secure transactions through a dedicated payment gateway.

## Features

- **User Authentication**: Secure registration and login system powered by Laravel Breeze.
- **Product Catalog**: Dynamic product listing with detailed descriptions and pricing.
- **Shopping Cart**: Efficient cart management for a seamless user experience.
- **Payment Integration**: Secure online payment processing via Midtrans Payment Gateway.
- **Responsive Interface**: Optimized for various devices using Tailwind CSS.
- **Database Management**: Structured data persistence utilizing Laravel's Eloquent ORM.

## Tech Stack

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Tailwind CSS, Alpine.js
- **Build Tool**: Vite
- **Payment Gateway**: Midtrans
- **Database**: Supported databases via Laravel's database-agnostic schema migrations

## Prerequisites

Ensure the following tools are installed on your local environment:

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- A database server (MySQL, PostgreSQL, or SQLite)

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/RizWithYa/Web-E-Commerce-Cloud-Computing.git
   cd itb-speedshop
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node dependencies:
   ```bash
   npm install
   ```

4. Configure the environment variables:
   - Copy the `.env.example` to `.env`
   - Update the database credentials and Midtrans API keys in the `.env` file

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Build the frontend assets:
   ```bash
   npm run build
   ```

## Local Development

To start the development server, you can use the built-in script:

```bash
composer run dev
```

Alternatively, run the following commands in separate terminals:

```bash
php artisan serve
npm run dev
```

## Security

If you discover any security-related issues, please contact the maintainers directly through the repository's issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
