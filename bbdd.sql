-- Crear la base de datos
CREATE DATABASE inmobiliaria;

-- Seleccionar la base de datos
USE inmobiliaria;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo_electronico VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'agente', 'cliente') NOT NULL,
    telefono VARCHAR(15),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de propiedades
CREATE TABLE propiedades (
    id_propiedad INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    tipo ENUM('casa', 'departamento', 'terreno', 'local') NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    codigo_postal VARCHAR(10) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_agente INT,
    FOREIGN KEY (id_agente) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
);

-- Tabla de imágenes
CREATE TABLE imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_propiedad INT,
    url_imagen VARCHAR(255) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE
);

-- Tabla de citas
CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_propiedad INT,
    id_cliente INT,
    fecha_hora DATETIME NOT NULL,
    estado ENUM('pendiente', 'confirmado', 'cancelado') NOT NULL,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de reseñas
CREATE TABLE reseñas (
    id_reseña INT AUTO_INCREMENT PRIMARY KEY,
    id_propiedad INT,
    id_cliente INT,
    calificacion INT NOT NULL CHECK (calificacion BETWEEN 1 AND 5), -- Mantén el CHECK si usas MySQL 8.0+
    comentario TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de transacciones
CREATE TABLE transacciones (
    id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
    id_propiedad INT,
    id_cliente INT,
    tipo ENUM('compra', 'alquiler') NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de preferencias de búsqueda
CREATE TABLE preferencias_busqueda (
    id_preferencia INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    tipo_propiedad ENUM('casa', 'departamento', 'terreno', 'local') NOT NULL,
    rango_precio_min DECIMAL(10, 2),
    rango_precio_max DECIMAL(10, 2),
    localizacion VARCHAR(255),
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);
