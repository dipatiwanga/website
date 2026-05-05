CREATE DATABASE IF NOT EXISTS website_db;
USE website_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    caption TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Seed admin user (password: admin123)
INSERT IGNORE INTO users (username, password) VALUES ('admin', '$2y$10$wk.etnU4QvLnak2wnG6bieoIEd/dS.Pbdl1a/mtTGhPD2aPypGp9S');
