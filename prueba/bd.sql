-- Crear la base de datos tienda si no existe
CREATE DATABASE IF NOT EXISTS tienda;

-- Usar la base de datos tienda
USE tienda;

-- Crear la tabla t_usuarios
CREATE TABLE t_usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    email VARCHAR(255),
    pass VARCHAR(255)
);

-- Crear la tabla t_productos
CREATE TABLE t_productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    producto VARCHAR(255),
    precio VARCHAR(100),
    cantidad VARCHAR(100),
);
