# Aurum Jewellery Shop

## Project Overview
Aurum Jewellery Shop is a web-based e-commerce application built with Laravel. It allows users to browse a collection of jewellery, search for products using an AJAX-powered search bar, filter by categories, add items to a cart, and place orders. It also features a comprehensive Admin Dashboard for managing products (CRUD) and orders.

## Features
- **User Interface**:
    - Browse Products with pagination.
    - **AJAX Search**: Instant product search without page reload.
    - Category Filtering.
    - Shopping Cart & Checkout functionality.
    - User Authentication & Order History.
- **Admin Panel**:
    - Manage Products: Create, Read, Update, Delete (CRUD).
    - Manage Orders.
    - Admin Authentication.
- **API**:
    - Exposed endpoints for product data (`/api/products`).

## Requirements
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## Setup Instructions

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd Aurum-Jewellery-shop
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    npm run build
    ```

4.  **Environment Setup**
    - Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    - Update the `.env` file with your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations**
    - Create the database tables:
        ```bash
        php artisan migrate
        ```

7.  **Link Storage**
    - Create a symbolic link for public file storage (images):
        ```bash
        php artisan storage:link
        ```

## Usage Guide
- **Start the Server**:
    ```bash
    php artisan serve
    ```
- **Access the Application**:
    - Open your browser and visit `http://127.0.0.1:8000`.
- **Admin Access**:
    - Navigate to `/admin/login` to access the admin panel.

## APIs
- **Get All Products**: `GET /api/products`
- **Get Single Product**: `GET /api/products/{id}`
