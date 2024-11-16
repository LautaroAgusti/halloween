-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS halloween;

-- Usar la base de datos
USE halloween;

-- Tabla: disfraces
CREATE TABLE IF NOT EXISTS disfraces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    votos INT NOT NULL DEFAULT 0,
    foto VARCHAR(20) NOT NULL,
    foto_blob BLOB,
    eliminado INT NOT NULL DEFAULT 0
);

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    clave TEXT NOT NULL
);

-- Tabla: votos
CREATE TABLE IF NOT EXISTS votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_disfraz INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_disfraz) REFERENCES disfraces(id)
);
 