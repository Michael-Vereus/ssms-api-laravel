# SSMS API (Laravel)

RESTful backend API for the SSMS system built using Laravel.

This project is a refactored version of a native PHP backend, redesigned using Laravel’s routing, controller structure, and response handling to achieve a cleaner and more maintainable architecture.

---

## Tech Stack

- PHP 8.3
- Laravel
- Composer
- SQLite
- RESTful API design
- Strict typing (PHP)

---

## Features

- RESTful API endpoints
- Clean routing using Laravel Router
- JSON responses
- MVC architecture
- SQLite database support
- Composer dependency management
- Structured controllers
- Strict typing enabled

---

## Installation

### 1. Clone repository

```bash
git clone https://github.com/Michael-Vereus/ssms-api-laravel.git
cd ssms-api-laravel
```

### 2. Install dependencies

```bash
composer install
```

### 3. Setup environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Create SQLite database

```bash
touch database/database.sqlite
```

Edit `.env`:

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/project/database/database.sqlite
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Start development server

```bash
php artisan serve
```

Server will run at:

```
http://127.0.0.1:8000
```

---

## API Base URL

```
http://127.0.0.1:8000/api
```

---

## Example Endpoint

### Test Endpoint

Request:

```
GET /api/test
```

Response:

```json
{
  "msg": "API is Running"
}
```

---

## Project Structure

```
app/
 └── Http/
     └── Controllers/

routes/
 └── api.php

database/
 ├── migrations/
 └── database.sqlite

config/
bootstrap/
storage/
```

---

## Useful Commands

Show all registered routes:

```bash
php artisan route:list
```

Clear caches:

```bash
php artisan optimize:clear
```

Run migrations:

```bash
php artisan migrate
```

Start local server:

```bash
php artisan serve
```

---

## Development Notes

This project focuses on understanding Laravel backend architecture by transitioning from manual PHP routing (front controller + switch case) into Laravel’s structured routing system.

Concepts explored:

- Laravel Router
- Controllers
- JSON responses
- REST API design
- MVC structure
- Strict typing in PHP
- Artisan CLI workflow

---

## Author

Michael Vereus

GitHub:
https://github.com/Michael-Vereus

---

## Purpose

Created as a learning project to explore how modern PHP frameworks manage routing, request lifecycle, and API structure compared to native PHP implementations.