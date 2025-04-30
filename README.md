
# Contact Form with Admin Panel (PHP + MySQL)

A simple contact form built with PHP and MySQL. It includes:
- A contact form for collecting user name, surname, email and message
- Basic anti-bot honeypot protection
- Server-side email validation with domain (MX record) check
- Admin panel to view submissions
- Clean, responsive CSS styling with fade-in effects  

---

## Features

- Contact form with fields: **Name**, **Email**, **Message**
- Honeypot anti-bot hidden field
- Email format and domain validation using PHP
- Submissions saved in a MySQL database
- Admin panel to view all messages
- Simple UI with CSS animations

---

## Setup Instructions

### 1 Create the Database and Table

Open your preferred MySQL management tool (e.g. phpMyAdmin) and run:

```sql
CREATE DATABASE contact_form;

USE contact_form;

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  date_submitted DATETIME NOT NULL
);
```

---

### 2 Configure Database Connection

In `db.php`, update your database credentials:

```php
$servername = "localhost";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "contact_form";
```

---

### 3 Place the Files

Copy all project files into your web server's root directory in a folder 
called "contact_management_system" (e.g. `htdocs/contact_management_system` for XAMPP).

**Files:**
- `index.php`  
- `admin.php`  
- `db.php`  
- `header.php`  
- `style.css`  
- `README.md`

---

### 4 Access the Application

- Open your browser and navigate to `http://localhost/contact_management_system/index.php` this is the contact form.
- To view submitted user information and messages, go to `http://localhost/contact_management_system/admin.php`

---

## Notes

- Honeypot protection uses a hidden `phone` field that bots typically fill in - if it's not empty, the form submission is blocked.
- The email domain validation uses PHP's `checkdnsrr()` to ensure the domain has a valid MX record.

---

## Project Structure

```
/contact-form/
├── admin.php
├── db.php
├── header.php
├── index.php
├── style.css
└── README.md
```

---

## Contact

For questions or improvements, feel free to reach out to Clinton Crawford.
