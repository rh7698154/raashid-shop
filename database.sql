CREATE DATABASE IF NOT EXISTS raashid_shop
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE raashid_shop;

CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  description TEXT NULL,
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  image_url VARCHAR(1000) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price, image_url) VALUES
('Wireless Headphones', 'Comfortable headphones for music and everyday use.', 29.99, ''),
('Everyday Backpack', 'A practical backpack for school, work, and travel.', 34.50, ''),
('Classic Wristwatch', 'A simple watch with a clean, timeless design.', 45.00, '');
