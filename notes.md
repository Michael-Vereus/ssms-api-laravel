# SSMS API (Laravel Edition)

[![Laravel](https://img.shields.io/badge/Framework-Laravel-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A sophisticated RESTful backend for the **Simple Storage Management System (SSMS)**. This project represents a strategic refactor of a native PHP implementation, leveraging Laravel’s robust routing, dependency injection, and controller systems to achieve a more decoupled and maintainable architecture.

---

## 🚀 Architectural Vision

This repository serves as a practical exploration of modern PHP standards and software design patterns. By migrating from a manual "front-controller" switch-case router to Laravel’s service-oriented architecture, the project implements:

* **Strict Typing:** Ensuring type safety across all layers of the application.
* **Decoupled Logic:** Transitioning business logic out of global scripts and into structured Controllers and Services.
* **Repository Pattern:** Implementing abstractions to ensure the data access layer remains independent of the business logic.
* **RESTful Standards:** Clean, predictable URL structures and JSON-based communication.

---

## 🛠 Tech Stack

* **Language:** PHP 8.3+ (Strict Types enabled)
* **Framework:** Laravel 11.x
* **Database:** SQLite
* **Dependency Management:** Composer
* **API Protocol:** RESTful JSON

---

## 📦 Installation & Setup

### 1. Clone the Repository
```bash
git clone [https://github.com/Michael-Vereus/ssms-api-laravel.git](https://github.com/Michael-Vereus/ssms-api-laravel.git)
cd ssms-api-laravel
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
 ├── Http/
 │    └── Controllers/   <-- Orchestrates request/response flow
 ├── Services/           <-- Business logic layer (MVSRC)
 ├── Repositories/       <-- Data abstraction layer
 └── Models/             <-- Eloquent entities
routes/
 └── api.php             <-- Defined RESTful endpoints
database/
 ├── migrations/         <-- Version-controlled database schema
 └── database.sqlite     <-- Local data storage
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