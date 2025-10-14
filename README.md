# Nami Soft - Project Management Dashboard

A simple Laravel-based dashboard to manage and monitor employees, projects, modules, and work time records in one place.  
The dashboard uses AJAX to fetch and display data dynamically without reloading the page.

---

## Overview

This project provides a clean admin dashboard where you can:
- View data from multiple tables (Employees, Projects, Modules, Work Times)
- Filter which table to display using a dropdown selector
- Fetch data dynamically via AJAX requests
- Log out using an AJAX-based logout button

It’s mainly built as a lightweight management tool or a practice task for handling AJAX operations, database relationships, and Laravel backend structure.

---

## Tech Stack

- **Laravel 11**
- **MySQL**
- **Bootstrap 5**
- **jQuery / AJAX**

---

## Features

- Responsive admin dashboard UI  
- AJAX-based table filtering  
- Secure CSRF handling in requests  
- Logout without page reload  
- Organized database structure with relationships:
  - `employees`
  - `projects`
  - `moduls`
  - `work_times` (links all others)

---

## Installation

1. Clone the repository  
   ```bash
   git clone https://github.com/yourusername/nami-soft-dashboard.git
