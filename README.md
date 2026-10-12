# Raashid Shop

A beginner-friendly shop website built with HTML, CSS, PHP, and MySQL. Designed to run locally with XAMPP.

## Features
- Responsive product storefront
- Search products by name or description
- MySQL-backed product listing
- Admin form to add products
- Prepared SQL statements for search and inserts
- Starter product data

## Run locally
1. Copy the `raashid_shop` folder into `C:\\xampp\\htdocs\\`.
2. Open XAMPP Control Panel and start Apache and MySQL.
3. Open `http://localhost/phpmyadmin`.
4. Select Import, choose `database.sql`, and run the import.
5. Open `http://localhost/raashid_shop/`.
6. Add products at `http://localhost/raashid_shop/admin.php`.

Default `db.php` settings are for typical XAMPP (`root` with a blank password). Update them if your MySQL setup differs.

## Important
This is a learning/demo shop. The admin page is not protected by login, and the Order button opens an email draft rather than processing payments. Do not publish as a production store until authentication, validation, HTTPS, CSRF protection, and secure checkout are added.
