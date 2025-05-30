# ChronosRevel – Event Listing Application

A PHP-based web application for managing and browsing events. Administrators can add, edit, and delete events, while public users can view, search, and register for upcoming events.

## 1. Assignment Overview

This assignment (CSYM019) demonstrates the implementation of a web-based event management system using PHP, JavaScript, and MariaDB, containerized with Docker. Core learning outcomes include:

* Implementing CRUD operations (Create, Read, Update, Delete)
* Managing user sessions and authentication
* Building responsive interfaces with CSS and JavaScript
* Containerizing applications with Docker & Docker Compose
* Designing and initializing a relational database schema

## 2. Features & Objectives

* **Secure Admin Panel**: User authentication with PHP sessions
* **Event CRUD**: Create, list, edit, and delete events
* **Public Listing**: Search, filter (by category/date), and pagination
* **Dockerized Environment**: PHP 8.2 and MariaDB services
* **Responsive Design**: Mobile-friendly layout with custom CSS and JS

## 3. Architecture & Database

### 3.1 High-Level Architecture

* **PHP**: Main logic in `websites/default/public/admin` (controllers) & `Includes` (templates)
* **JavaScript**: Frontend enhancements and AJAX calls in `js/`
* **MariaDB**: Data storage for events, users, and registrations

### 3.2 Database Schema

| Table    | Columns                   | Description                           
| `admins` | `id` INT UNSIGNED, `username` VARCHAR(50), `password` VARCHAR(255), `created_at` TIMESTAMP | Stores administrator credentials |
| `events` | `id` INT, `title` VARCHAR(255), `description` TEXT, `location` VARCHAR(255), `category` VARCHAR(100), `event_date` DATE `image_path` VARCHAR(255), `created_by` INT, `created_at` TIMESTAMP, `updated_at` TIMESTAMP | Event details with reference to an admin |

## 4. Project Structure Project Structure

```
.
├── PHP.Dockerfile            # Dockerfile for PHP built-in server
├── docker-compose.yml        # Defines PHP and MariaDB services
└── websites
    └── default
        ├── .vscode           # VSCode workspace settings (optional)
        ├── database          # Database files
        │   └── database.sql  # SQL schema & seed data
        └── public            # Web root for PHP application
            ├── admin         # Admin-only pages
            │   ├── add_event.php
            │   ├── dashboard.php
            │   ├── delete_event.php
            │   ├── edit_event.php
            │   ├── history.php
            │   ├── login.php
            │   ├── logout.php
            │   ├── register_validation.php
            │   ├── registration.php
            │   └── update_profile.php
            ├── api           # AJAX / REST endpoints
            │   └── get_events.php
            ├── Includes      # Shared templates & config
            │   ├── config.php
            │   ├── session.php
            │   ├── header_admin.php  # admin header
            │   ├── header_public.php  # user header
            │   └── footer.php
            ├── js            # Frontend scripts
            │   ├── dashboard.js
            │   ├── event_search.js
            │   └── registration.js
            ├── fonts         # Custom fonts
            ├── icons         # Site icons & logos
            ├── uploads       # Admin-uploaded event images
            ├── vje.css       # Main stylesheet
            ├── index.php     # Public homepage / event listing
            ├── event_listing.php  # Event listing page
            ├── about_us.php  # Static about page
            └── pexels-wendywei-1190298.jpg        # Static images
```

## 5. Setup & Installation

### 5.1 Clone Repository

```bash
git clone <your-repo-url>.git
cd <your-repo-folder>
```

### 5.2 Build & Start Containers

```bash
docker-compose up --build -d
```

* PHP service on `localhost:8000`
* MariaDB on port `3308`

### 5.3 Initialize Database

**Host MySQL client:**

```bash
mysql -h 127.0.0.1 -P 3308 -u v.je -pchronosrevel chronosrevel < websites/default/database/database.sql
```

**Inside MariaDB container:**

```bash
docker exec -i $(docker-compose ps -q mysql) mysql -u root -pv.je chronosrevel < websites/default/database/database.sql
```

## 6. Usage & Screenshots

* **Admin Panel:** `http://localhost:8000/admin/dashboard.php`
* **Event Listing:** `http://localhost:8000/index.php`

## 7. Testing & Validation

* Manual form tests for empty/invalid inputs and SQL injection attempts.
* Verified Docker rebuild resets the database.
* Confirmed responsive layout on desktop and mobile resolutions.

## 8. Future Improvements

* Add email confirmation for registrations
* Implement user roles (organizers vs. attendees)
* Develop a full RESTful API
* Enhance accessibility (ARIA labels, keyboard nav)

## 9. References

* [PHP Manual](https://www.php.net/docs.php)
* [Docker Compose Documentation](https://docs.docker.com/compose/)
* StackOverflow threads for PHP session management

## 10. Contributing

If you’d like to suggest improvements, feel free to open an issue or pull request.