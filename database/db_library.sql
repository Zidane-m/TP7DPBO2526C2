CREATE DATABASE IF NOT EXISTS db_library;
USE db_library;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(13) UNIQUE,
    stock INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15)
);

CREATE TABLE IF NOT EXISTS loans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    member_id INT NOT NULL,
    loan_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE
);

INSERT INTO books (title, author, isbn, stock) VALUES
('Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', '9786020633071', 5),
('Atomic Habits', 'James Clear', '9780735211292', 3),
('The Power of Habit', 'Charles Duhigg', '9780812981605', 4),
('7 Habits of Highly Effective People', 'Stephen R. Covey', '9780743269513', 2);

INSERT INTO members (name, email, phone) VALUES
('Putra Donatur Kampus', 'putra@donatur.com', '08123456789'),
('Nanang Resing Acikiwir', 'nanang@resing.com', '08234567890');

INSERT INTO loans (book_id, member_id, loan_date, return_date) VALUES
(1, 1, '2026-11-01', '2026-11-05'),
(2, 2, '2026-11-03', NULL);
