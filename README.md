# Product Inventory Management System
A simple CRUD web app (HTML, CSS, JavaScript, PHP, MySQLi, MySQL) for tracking products.

## Features
- **Create** – add products (validated server-side)
- **Read** – list and search products; low stock (≤10) highlighted
- **Update** – edit any product
- **Delete** – remove a product (POST + confirmation)
- Prepared statements (MySQLi) to prevent SQL injection; output escaped to prevent XSS

## Structure
```
index.php     list/search (Read)
form.php      add + edit (Create/Update)
delete.php    delete (Delete)
config.php    MySQLi connection
database.sql  table + sample data
assets/       style.css, app.js
```

## Run locally (XAMPP)
1. Copy folder to `htdocs/inventory-app`.
2. In phpMyAdmin create DB `inventory_db`, import `database.sql`.
3. Visit http://localhost/inventory-app/

## Deploy on InfinityFree
1. Create account → create hosting account → note your subdomain.
2. Control Panel → **MySQL Databases** → create a database. Note host, username, DB name, and your password.
3. Open **phpMyAdmin**, select the database, **Import** `database.sql`.
4. Edit `config.php` with the InfinityFree host/user/pass/name.
5. **Online File Manager** (or FTP) → upload all files into `htdocs/`.
6. Visit `http://yoursubdomain.infinityfreeapp.com` and test all four CRUD functions.

## Live URL
http://YOUR-SUBDOMAIN.infinityfreeapp.com

## Online testing
Share the URL with classmates and record their feedback in the table below.
| Tester | Add | View | Edit | Delete | Comments |
|--------|-----|------|------|--------|----------|
