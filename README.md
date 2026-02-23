# ChronosRevel – Event Listing Application

ChronosRevel is a PHP-based web application for managing and displaying events. It provides a secure administrative dashboard for event management and a public interface for browsing and registering for events. The project demonstrates full-stack development using PHP, MariaDB, JavaScript, and Docker.

---

## Key Features

* Secure admin authentication (PHP sessions)
* Full CRUD operations for events
* Public event listing with search and filtering
* Image uploads for events
* Responsive design (HTML, CSS, JavaScript)
* Dockerized environment (PHP 8.2 + MariaDB)

---

## Tech Stack

* PHP 8.2
* MariaDB
* JavaScript (AJAX)
* Docker & Docker Compose

---

## Setup

```bash
git clone <your-repository-url>.git
cd <your-repository-folder>
docker-compose up --build -d
```

Initialize the database:

```bash
mysql -h 127.0.0.1 -P 3308 -u v.je -pchronosrevel chronosrevel < websites/default/database/database.sql
```

---

## Access

* Admin: [http://localhost:8000/admin/dashboard.php](http://localhost:8000/admin/dashboard.php)
* Public: [http://localhost:8000/index.php](http://localhost:8000/index.php)

---

## Academic Context

Developed for **CSYM019 – Web Development** to demonstrate CRUD implementation, authentication, database design, and containerized deployment.

---

## Author

Your Name
