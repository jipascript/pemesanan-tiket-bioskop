CREATE DATABASE IF NOT EXISTS tiket_bioskop;
USE tiket_bioskop;

CREATE TABLE tiket (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  film VARCHAR(100) NOT NULL,
  jadwal VARCHAR(20) NOT NULL,
  jumlah INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);