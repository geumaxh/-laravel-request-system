# Laravel Request System

## Project Description
A web-based request management system built with Laravel and MySQL, designed for MENRO Juban to streamline administrative processes.

## Student Information
- **Name:** Maxene D. Pereira
            Hermionie Bernabe
- **Course:** BS in Information Technology
- **Year & Section:** 4-3
- **Institution:** Sorsogon State University - Bulan Campus

## Software Requirements
- PHP 8.1 or higher
- Laravel 10.x or higher
- MySQL 5.7 or higher
- Composer
- Git

## Installation Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/geumaxh/laravel-request-system.git
cd laravel-request-system
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Update Database Credentials in .env

### 5. Create Database
```bash
mysql -u root -p
CREATE DATABASE laravel_request_system_db;
EXIT;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Start Development Server
```bash
php artisan serve
```

Access at: http://127.0.0.1:8000

## Database Name
`laravel_request_system_db`

## GitHub Repository
https://github.com/geumaxh/laravel-request-system

## Deployment Link
(Add if deployed)