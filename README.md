# Health Promotion Board (HPB) - Work-Life Balance Web Portal

This repository contains a full-stack web application designed for the Health Promotion Board to promote work-life balance, nutrition, and mental well-being. The project is built using PHP, MySQL, and CSS, and is optimized for deployment via XAMPP.

---

## ## Project Overview

The portal serves as an interactive platform where users can learn about health essentials, view upcoming wellness events, and register for workshops. It also includes a secure administrative backend for managing user registrations.

### Key Features

* **User Registration**: Functional RSVP system for events like Mindfulness Workshops and Yoga sessions.
* **Health Articles**: Dedicated sections for Nutrition, Exercise, and Mental Health with smooth-scroll navigation.
* **Admin Dashboard**: A secure area to view, edit, and delete user registrations.
* **Security**: Implementation of CSRF tokens for admin logins and password-protected dashboard access.
* **Responsive Design**: A mobile-friendly interface styled with custom CSS.

---

## ## Technology Stack

* **Frontend**: HTML5, CSS3, JavaScript (for smooth scrolling and form validation).
* **Backend**: PHP 8.x.
* **Database**: MySQL.
* **Environment**: XAMPP / WAMP.

---

## ## File Structure

The project consists of the following core files:

| File | Description |
| --- | --- |
| `index.php` | The landing page featuring the hero section and quick links. |
| `info.php` | Educational content regarding nutrition, exercise, and mental health. |
| `events.php` | Interactive event calendar and registration processing. |
| `register.php` | Dedicated event signup form for users. |
| `admin_login.php` | Secure login portal for administrators with CSRF protection. |
| `admin_dashboard.php` | Management interface to view and modify user data. |
| `manage.php` | Backend logic for handling "Edit" and "Delete" actions on user records. |
| `dbconnect.php` | Database connection configuration. |
| `health.sql` | SQL script to initialize the `health` database and tables. |
| `style.css` | Global stylesheet for layout, buttons, and responsive tables. |

---

## ## Installation & Setup

1. **Install XAMPP**: Download and install XAMPP (with PHP 8.x support).
2. **Clone the Repository**: Place all files into the `C:/xampp/htdocs/hpb_portal/` directory.
3. **Database Setup**:
* Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
* Create a new database named `health`.
* Import the `health.sql` file provided in this repository.


4. **Configure Connection**:
* Ensure `dbconnect.php` reflects your local server settings (Default is `127.0.0.1:3308`, user `root`, no password).


5. **Run the App**:
* Start Apache and MySQL modules in the XAMPP Control Panel.
* Navigate to `http://localhost/hpb_portal/index.php`.



---

## ## Admin Credentials

To access the admin dashboard (`admin_login.php`), use the default credentials found in the database dump:

* **Username**: `admin`
* **Password**: `admin123`
