# Laravel Request System

## Project Description

A web-based request management system built with Laravel and MySQL, designed for MENRO Juban to streamline administrative processes, request submission, review, approval, and record management.

## Student Information

- **Names:** Maxene D. Pereira and Hermionie Bernabe
- **Course:** BS in Information Technology
- **Year & Section:** 4-3
- **Institution:** Sorsogon State University – Bulan Campus

## Software Requirements

The project uses Docker to run the application and database.

- Docker Desktop with Docker Compose
- Git
- Visual Studio Code or another code editor
- Internet connection

PHP, Composer, Laravel, and MySQL are provided through the project's Docker environment.

## Request Data Model

The `requests` table stores request information used by the application. The exact columns and constraints are defined in the Laravel migration files located in `database/migrations`.

Common request fields include:

| Field | Purpose |
|---|---|
| `id` | Unique request identifier |
| `user_id` | Identifies the user who owns the request |
| `item_name` | Name of the requested item |
| `quantity` | Quantity requested |
| `purpose` | Reason for the request |
| `status` | Current request status |
| `created_at` | Date and time the request was created |
| `updated_at` | Date and time the request was last updated |

Refer to the actual migration files for the complete table structure.

### Migration Commands

To run database migrations in Docker:

```bash
docker compose --env-file .env.container exec app php artisan migrate
```

To check migration status:

```bash
docker compose --env-file .env.container exec app php artisan migrate:status
```

Do not use destructive migration commands on a database containing records that must be preserved.

## User Stories

### Story 1: Requester

As a requester, I want to submit a request for items or services so that I can obtain what I need through the proper approval process.

### Story 2: Staff Reviewer

As a staff reviewer, I want to view requests and update their status so that I can track which requests are approved, rejected, or being processed.

### Story 3: Record Keeper

As a record keeper, I want to maintain request records and their creation and modification dates so that I can support accurate record-keeping.

## Installation Instructions

These instructions help another user reproduce the application in a separate environment.

### 1. Install the Requirements

Install Docker Desktop with Docker Compose and Git. Make sure Docker Desktop is running before proceeding.

### 2. Clone the Repository

Open a terminal in the directory where you want to store the project.

```bash
git clone https://github.com/geumaxh/laravel-request-system.git laravel_request_system_review
cd laravel_request_system_review
```

The destination folder is named `laravel_request_system_review` to avoid conflicts if a folder named `laravel-request-system` or `laravel_request_system` already exists.

### 3. Configure the Environment

Create a private environment file using the example provided in the repository.

**Windows Command Prompt:**

```cmd
copy .env.container.example .env.container
```

**macOS or Linux:**

```bash
cp .env.container.example .env.container
```

Open `.env.container` and configure the required values according to the Docker Compose configuration and example file.

Use appropriate local credentials. Do not upload the private `.env.container` file, passwords, or application secrets to GitHub.

Do not copy another developer's private environment file. The example file should contain placeholders, not working secrets.

### 4. Build and Start the Docker Environment

From the project directory, run:

```bash
docker compose --env-file .env.container up -d --build
```

Check the status of the services:

```bash
docker compose --env-file .env.container ps
```

Confirm that the application, web server, and database services are running. If the database has a health check, wait until it reports healthy.

### 5. Run Database Migrations

Run the migrations inside the application container:

```bash
docker compose --env-file .env.container exec app php artisan migrate
```

If an error occurs, review the error message and verify the environment configuration before continuing.

### 6. Open the Application

Open the following address in a web browser:

**http://127.0.0.1:8080/requests**

Log in using an appropriately configured account. If a fresh installation has no user accounts, follow the project's approved account-creation procedure.

### 7. Verify the Installation

Check the following:

- Docker services start successfully.
- The database becomes healthy, if a health check is configured.
- Database migrations complete successfully.
- The application opens in the browser.
- Authorized users can access the appropriate request pages.
- Request records can be viewed.
- Database persistence can be checked after restarting the containers.

Record any errors encountered and how they were resolved.

### 8. Stop the Environment

When testing is complete, run:

```bash
docker compose --env-file .env.container down
```

This stops and removes the Compose containers and network without explicitly deleting the named database volume.

Avoid using `docker compose down -v` when database records must be preserved.

## Database Information

The application uses MySQL through Docker Compose. The database name and connection settings are configured through the private environment file and the Compose configuration.

Use the migration files in `database/migrations` to verify the actual table structure.

## GitHub Repository

[Laravel Request System Repository](https://github.com/geumaxh/laravel-request-system)

## Deployment Link

The application is documented for local Docker-based execution. Add a deployment URL here if the system is deployed to a publicly accessible hosting environment.

## Lab 3: Secure Request Access Through Reviewed Changes

### Security Implementation

The project implements or is intended to enforce secure request access through server-side authorization, input validation, and CSRF protection.

### Ownership Rules

Students should only access their own requests, while administrators may view all requests according to the application's authorization rules. Unauthorized access should be denied.

### Security Features

1. **CSRF Protection:** State-changing forms use Laravel's CSRF protection.
2. **XSS Prevention:** Blade's escaped output syntax (`{{ }}`) is used where appropriate.
3. **Server-Side Validation:** Request data is validated before being saved.
4. **Trusted Field Assignment:** Sensitive fields such as `user_id` and `status` are controlled server-side.
5. **Secret Exclusion:** Private environment files are excluded from Git tracking and the Docker build context.
6. **Database Persistence:** MySQL data is stored in a named Docker volume.

### Testing

Record the results of test cases T01–T09 based on the actual test evidence. Mark each test as passed or failed according to its observed result, and document any unresolved issues.

## Environment Reproduction Evidence

For the environment reproduction activity, the reviewer should:

1. Clone the GitHub repository into a separate folder or environment.
2. Configure a private environment file using `.env.container.example`.
3. Follow the documented Docker setup instructions.
4. Verify that the application and database start successfully.
5. Open the application and check its basic functionality.
6. Capture screenshots of the setup commands, running containers, and working application.

The reproduction result should be recorded based on the reviewer's actual execution, including any problems encountered and their resolution.