DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    encrypted_password VARCHAR(255) NOT NULL,
    avatar_name VARCHAR(65),
    role ENUM('admin', 'user') DEFAULT 'user' NOT NULL

);

DROP TABLE IF EXISTS problems;