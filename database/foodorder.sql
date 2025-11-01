-- database/foodorder.sql
CREATE DATABASE IF NOT EXISTS foodorder CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE foodorder;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  direccion VARCHAR(255),
  total DECIMAL(10,2) DEFAULT 0,
  estado ENUM('pendiente','en_preparacion','en_transito','entregado') DEFAULT 'pendiente',
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
