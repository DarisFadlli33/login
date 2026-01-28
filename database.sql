CREATE DATABASE login_system;
USE login_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','anggota')
);

CREATE TABLE kegiatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100),
    deskripsi TEXT,
    tanggal DATE
);

-- akun admin default
INSERT INTO users (nama, username, password, role)
VALUES (
    'Administrator',
    'admin',
    MD5('admin123'),
    'admin'
);
