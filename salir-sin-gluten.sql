
CREATE DATABASE proyectointegrado;

USE proyectointegrado;

-- Crear la tabla "usuario"
CREATE TABLE usuario (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  es_administrador BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);

-- Insertar el usuario administrador
INSERT INTO usuario (nombre, email, password, es_administrador)
VALUES ('admin', 'admin@gmail.com', 'admin', 1);

-- Crear la tabla "restaurantes"
CREATE TABLE restaurantes (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  texto TEXT,
  puntuacion FLOAT,
  web VARCHAR(255),
  telefono VARCHAR(20),
  codigo_postal VARCHAR(10) NOT NULL,
  provincia VARCHAR(255) NOT NULL,
  ciudad VARCHAR(255) NOT NULL,
  ruta_imagen VARCHAR(255),  -- utiliza una columna VARCHAR para almacenar la ruta de la imagen
  PRIMARY KEY (id)
);

-- Crear la tabla "reseñas"
CREATE TABLE reseñas (
  id INT NOT NULL AUTO_INCREMENT,
  id_restaurante INT NOT NULL,
  id_usuario INT NOT NULL,
  fecha DATE NOT NULL,
  texto TEXT,
  puntuacion FLOAT,
  ruta_imagen VARCHAR(255),  -- utiliza una columna VARCHAR para almacenar la ruta de la imagen
  PRIMARY KEY (id),
  FOREIGN KEY (id_restaurante) REFERENCES restaurantes(id),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

INSERT INTO usuario (nombre, email, password, es_administrador)
VALUES ('david', 'david@gmail.com', 'admin', 0);

SELECT * FROM restaurantes;

SELECT * FROM usuario;