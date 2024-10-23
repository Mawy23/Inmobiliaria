-- --------------------------------------------------------
-- Estructura de tabla para la tabla `usuarios`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre_usuario` VARCHAR(20) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(60) NOT NULL,
    `id_rol` BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
    FOREIGN KEY (`id_rol`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------
-- Estructura de tabla para la tabla `roles`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `agentes`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `agentes` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(30) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `telefono` VARCHAR(15) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `id_usuario` BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `transacciones`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `transacciones` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `fecha` DATE NOT NULL,
    `monto` DECIMAL(12,2) NOT NULL,
    `tipo` ENUM('Compra', 'Venta', 'Alquiler') NOT NULL,
    `id_inmueble` BIGINT(20) UNSIGNED NOT NULL,
    `id_cliente` BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles`(`id`),
    FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `documentos`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `documentos` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nombre` varchar(50) NOT NULL,
    `ruta` varchar(255) NOT NULL,
    `id_inmueble` bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `citas`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `citas` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `fecha` DATE NOT NULL,
    `hora` TIME NOT NULL,
    `motivo` VARCHAR(50) NOT NULL,
    `lugar` VARCHAR(30) NOT NULL,
    `id_cliente` BIGINT(20) UNSIGNED NOT NULL,
    `id_agente` BIGINT(20) UNSIGNED DEFAULT NULL, -- Relación con agentes, se permite estar vacio 
    `estado` ENUM('Pendiente', 'Confirmada', 'Cancelada') DEFAULT 'Pendiente',
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id`),
    FOREIGN KEY (`id_agente`) REFERENCES `agentes`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `clientes`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `clientes` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(15) NOT NULL,
    `apellidos` VARCHAR(30) NOT NULL,
    `direccion` VARCHAR(50) NOT NULL,
    `telefono1` VARCHAR(9) NOT NULL,
    `telefono2` VARCHAR(9) DEFAULT NULL,
    `id_usuario` BIGINT(20) UNSIGNED NOT NULL, -- Relación con usuarios
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `inmuebles`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inmuebles` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `direccion` VARCHAR(50) NOT NULL,
    `descripcion` VARCHAR(1500) NOT NULL,
    `precio` DECIMAL(12,2) NOT NULL,
    `tipo` ENUM('Chalet', 'Piso', 'Local') DEFAULT NULL,
    `id_cliente` BIGINT(20) UNSIGNED NOT NULL,
    `imagen` VARCHAR(100) NOT NULL,
    `id_agente` BIGINT(20) UNSIGNED DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id`),
    FOREIGN KEY (`id_agente`) REFERENCES `agentes`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



