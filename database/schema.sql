SET foreign_key_checks = 0;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    encrypted_password VARCHAR(255) NOT NULL,
    avatar_name VARCHAR(65),
    role ENUM('admin', 'user') DEFAULT 'user' NOT NULL
);

DROP TABLE IF EXISTS companies;
CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    fantasy_name VARCHAR(255),
    cnpj VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    tax_framework VARCHAR(255) NOT NULL,
    description TEXT,
    link VARCHAR(255),
    responsible VARCHAR(255),
    status VARCHAR(255) NOT NULL,
    accounting_fees VARCHAR(255),
    state_registration VARCHAR(255),
    recorded_at VARCHAR(255)
);

DROP TABLE IF EXISTS associates;
CREATE TABLE associates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    participation VARCHAR(255) NOT NULL,
    cpf VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    email VARCHAR(255),
    company_id INT NOT NULL,
    CONSTRAINT fk_company FOREIGN KEY (company_id)
    REFERENCES companies(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS subcategories;
CREATE TABLE subcategories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category_id INT NOT NULL,
    CONSTRAINT fk_category FOREIGN KEY (category_id)
    REFERENCES categories(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tutorials;
CREATE TABLE tutorials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    link VARCHAR(255) NOT NULL,
    recorded_at VARCHAR(65) NOT NULL,
    subcategory_id INT NOT NULL,
    CONSTRAINT fk_subcategory FOREIGN KEY (subcategory_id)
    REFERENCES subcategories(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS tag_tutorial_filter;
CREATE TABLE tag_tutorial_filter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tutorial_id INT NOT NULL,
    CONSTRAINT fk_tutorial FOREIGN KEY (tutorial_id)
    REFERENCES tutorials(id) ON DELETE CASCADE,
    tag_id INT NOT NULL,
    CONSTRAINT fk_tag FOREIGN KEY (tag_id)
    REFERENCES tags(id) ON DELETE CASCADE
);

SET foreign_key_checks = 1;
