-- Crear la base de datos
CREATE DATABASE inmobiliaria;

-- Seleccionar la base de datos
USE inmobiliaria;

-- Tabla de usuarios
CREATE TABLE
    usuarios (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(50) NOT NULL,
        correo_electronico VARCHAR(100) UNIQUE NOT NULL,
        contraseña VARCHAR(255) NOT NULL,
        rol ENUM ('admin', 'agente', 'cliente') NOT NULL,
        telefono VARCHAR(15),
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (rol)
    );

-- Historial de búsquedas
CREATE TABLE
    `search_history` (
        `id` int (11) NOT NULL,
        `tipo` varchar(255) DEFAULT NULL,
        `precio_min` decimal(10, 2) DEFAULT NULL,
        `precio_max` decimal(10, 2) DEFAULT NULL,
        `ciudad` varchar(255) DEFAULT NULL,
        `fecha` timestamp NOT NULL DEFAULT current_timestamp()
    );

-- Tabla de propiedades
CREATE TABLE
    propiedades (
        id_propiedad INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(100) NOT NULL,
        descripcion TEXT NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        tipo ENUM ('casa', 'departamento', 'terreno', 'local') NOT NULL,
        direccion VARCHAR(255) NOT NULL,
        ciudad VARCHAR(50) NOT NULL,
        estado ENUM ('disponible', 'vendido', 'alquilado') NOT NULL DEFAULT 'disponible',
        codigo_postal VARCHAR(10) NOT NULL,
        fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        id_agente INT,
        FOREIGN KEY (id_agente) REFERENCES usuarios (id_usuario) ON DELETE SET NULL,
        INDEX (id_agente)
    );

-- Tabla de imágenes
CREATE TABLE
    imagenes (
        id_imagen INT AUTO_INCREMENT PRIMARY KEY,
        id_propiedad INT,
        imagen LONGBLOB NOT NULL, -- Cambiar url_imagen a imagen y usar tipo LONGBLOB
        descripcion TEXT,
        FOREIGN KEY (id_propiedad) REFERENCES propiedades (id_propiedad) ON DELETE CASCADE
    );

-- Tabla de citas
CREATE TABLE
    citas (
        id_cita INT AUTO_INCREMENT PRIMARY KEY,
        id_propiedad INT,
        id_cliente INT DEFAULT NULL,
        id_agente INT,
        fecha_hora DATETIME NOT NULL,
        estado ENUM ('pendiente', 'confirmado', 'cancelado') NOT NULL,
        disponible BOOLEAN DEFAULT TRUE,
        FOREIGN KEY (id_propiedad) REFERENCES propiedades (id_propiedad) ON DELETE CASCADE,
        FOREIGN KEY (id_cliente) REFERENCES usuarios (id_usuario) ON DELETE CASCADE,
        FOREIGN KEY (id_agente) REFERENCES usuarios (id_usuario) ON DELETE CASCADE,
        INDEX (id_agente),
        INDEX (id_propiedad)
    );

-- Tabla de tasaciones
CREATE TABLE
    tasacion (
        id_tasacion int (11) NOT NULL AUTO_INCREMENT,
        nombre varchar(50) NOT NULL,
        apellido varchar(50) NOT NULL,
        correo varchar(100) NOT NULL,
        telefono varchar(15) NOT NULL,
        direccion varchar(255) NOT NULL,
        estado_tasacion enum ('pendiente', 'validada') NOT NULL DEFAULT 'pendiente',
        fecha_solicitud timestamp NOT NULL DEFAULT current_timestamp(),
        id_cliente INT,
        PRIMARY KEY (id_tasacion),
        FOREIGN KEY (id_cliente) REFERENCES usuarios (id_usuario) ON DELETE CASCADE
    );

-- Tabla de preferencias de búsqueda
CREATE TABLE
    preferencias_busqueda (
        id_preferencia INT AUTO_INCREMENT PRIMARY KEY,
        id_cliente INT,
        tipo_propiedad ENUM ('casa', 'departamento', 'terreno', 'local') NOT NULL,
        rango_precio_min DECIMAL(10, 2),
        rango_precio_max DECIMAL(10, 2),
        localizacion VARCHAR(255),
        FOREIGN KEY (id_cliente) REFERENCES usuarios (id_usuario) ON DELETE CASCADE
    );

-- Tabla de favoritos
CREATE TABLE
    favoritos (
        id_favorito INT AUTO_INCREMENT PRIMARY KEY,
        id_cliente INT NOT NULL,
        id_propiedad INT NOT NULL,
        FOREIGN KEY (id_cliente) REFERENCES usuarios (id_usuario) ON DELETE CASCADE,
        FOREIGN KEY (id_propiedad) REFERENCES propiedades (id_propiedad) ON DELETE CASCADE
    );

-- Insertar datos en la tabla de propiedades
INSERT INTO
    propiedades (
        titulo,
        descripcion,
        precio,
        tipo,
        direccion,
        ciudad,
        estado,
        codigo_postal,
        id_agente
    )
VALUES
    (
        'Casa Familiar en el Centro',
        'Hermosa casa con 3 habitaciones y jardín.',
        250000.00,
        'casa',
        'Calle Mayor 10',
        'Madrid',
        'disponible',
        '28001',
        NULL
    ),
    (
        'Departamento Moderno',
        'Departamento con vista al mar y piscina.',
        150000.00,
        'departamento',
        'Av. Marítima 5',
        'Barcelona',
        'disponible',
        '08002',
        NULL
    ),
    (
        'Terreno en las Afueras',
        'Terreno amplio para construcción.',
        100000.00,
        'terreno',
        'Ctra. Nacional 25',
        'Valencia',
        'disponible',
        '46001',
        NULL
    ),
    (
        'Local Comercial',
        'Local comercial en zona céntrica.',
        50000.00,
        'local',
        'Calle Comercio 3',
        'Sevilla',
        'vendido',
        '41001',
        NULL
    );

-- Vista para obtener propiedades favoritas con detalles
CREATE VIEW
    vista_favoritos AS
SELECT
    p.*,
    f.id_cliente
FROM
    propiedades p
    JOIN favoritos f ON p.id_propiedad = f.id_propiedad;