CREATE DATABASE buyerside;
USE buyerside;

CREATE TABLE users (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    user_type VARCHAR(50)
);

CREATE TABLE products (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255),
    price INT,
    image VARCHAR(255),
    product_detail TEXT,
    type ENUM('Berries', 'Drupes', 'Pomes', 'Citrus Fruits', 'Melons', 'Dried Fruits', 'Tropical Fruits', 'Others')
);

CREATE TABLE cart (
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(255),
    product_id VARCHAR(255),
    price INT,
    qty INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(255),
    name VARCHAR(255),
    number VARCHAR(255),
    email VARCHAR(255),
    address VARCHAR(255),
    address_type VARCHAR(255),
    method VARCHAR(255),
    product_id VARCHAR(255),
    price INT,
    qty INT,
    date DATE,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE wishlist (
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(255),
    product_id VARCHAR(255),
    price INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
