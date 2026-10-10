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

## Request Data Model

### Request Table Structure

The `requests` table stores all incoming requests with the following fields:

| Field | Type | Constraint | Purpose |
|-------|------|-----------|---------|
| id | BIGINT UNSIGNED | Primary Key | Unique request identifier |
| requester_name | VARCHAR(100) | Required | Name of person requesting |
| requester_email | VARCHAR(255) | Required | Contact email address |
| item_name | VARCHAR(150) | Required | Item or service name |
| quantity | UNSIGNED INT | Required, > 0 | Quantity requested |
| purpose | TEXT | Required | Reason for request |
| status | VARCHAR(20) | Default: pending | Request status (pending, approved, rejected, processing) |
| created_at | TIMESTAMP | Auto | Creation timestamp |
| updated_at | TIMESTAMP | Auto | Last update timestamp |

### Migration Command

To create the requests table, run:

```bash
php artisan migrate
```

### User Stories

#### Story 1: Requester
As a requester, I want to submit a request for items or services, so that I can obtain what I need through the proper approval process.

#### Story 2: Staff Reviewer
As a staff reviewer, I want to view all pending requests and update their status, so that I can track which requests are approved, rejected, or under review.

#### Story 3: Record Keeper
As a record keeper, I want to maintain a complete audit trail of all requests with their creation and modification dates, so that I can ensure data integrity and compliance with record-keeping requirements.

### Verify the Request Table

To check if the migration was successful:

```bash
php artisan migrate:status
```

To view the table structure in MySQL:

1. Open phpMyAdmin
2. Select database: `laravel_request_system_db`
3. Click table: `requests`
4. View the Structure tab

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


## Lab 3: Secure Request Access Through Reviewed Changes

### Security Implementation

This laboratory implements secure request access through server-side authorization, input validation, and CSRF protection.

#### Ownership Rules - Students can view only their own requests; admins see all

#### Access Control Methods
- All request routes protected with `auth` middleware
- Authorization enforced via `ServiceRequestPolicy`
- List views scoped by `user_id` (students see only their own; admins see all)

#### Request Routes


#### Input Validation Rules
- **item_name**: required, string, max 150 characters
- **quantity**: required, integer, minimum 1
- **purpose**: required, string, max 2000 characters
- **status**: admin only, must be one of: pending, approved, rejected

#### Security Features Implemented
1. **CSRF Protection**: All POST/PATCH forms include `@csrf` token
2. **XSS Prevention**: All output escaped with `{{ }}` in Blade templates
3. **Server-Side Validation**: Input validated before database writes
4. **Trusted Field Assignment**: user_id, status, and requester info assigned server-side (not from user input)
5. **Secret Exclusion**: .env file excluded from Git via .gitignore
6. **Authorization Checks**: Gate::authorize() enforced before reading or writing protected data

#### File Responsibilities
- **app/Models/ServiceRequest.php** - Data model with mass-assignment protection
- **app/Policies/ServiceRequestPolicy.php** - Authorization rules (viewAny, view, create, updateStatus)
- **app/Http/Controllers/ServiceRequestController.php** - Business logic, validation, trusted field assignment
- **resources/views/requests/** - Blade templates with CSRF tokens and escaped output
- **routes/web.php** - Route definitions with auth middleware

#### Testing Results
All T01-T10 security tests pass:
- T01: Guest redirect to login ✓
- T02: Students see only own requests ✓
- T03: Access denied to other student's request (403) ✓
- T04: Students cannot update status ✓
- T05: Admin can view all and update status ✓
- T06: Invalid input rejected ✓
- T07: Cannot spoof user_id/status/role ✓
- T08: HTML/XSS escaped ✓
- T09: CSRF tokens required ✓
- T10: Invalid status rejected ✓

#### Dependency Audit


#### Deployment Security
- APP_DEBUG=false in production
- .env never tracked in Git
- Passwords hashed with Laravel Hash::make()
- Secret exposure: revoke/rotate, remove file, clean history