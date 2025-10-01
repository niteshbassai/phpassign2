CREATE DATABASE IF NOT EXISTS pizza_shop;

USE pizza_shop;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    pizza_size VARCHAR(20) NOT NULL,
    toppings TEXT NOT NULL,
    quantity INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);