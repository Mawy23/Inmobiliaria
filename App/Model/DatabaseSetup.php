<?php

// Incluye los archivos de configuración y modelo
include 'App/Config/Config.php';
include '../Core/Model.php'; // Asegúrate de que la ruta de Model.php es correcta

use Core\Model;

// Crear una nueva instancia de la clase Model para abrir la conexión a la base de datos
$model = new Model();
$conn = $model->db;

if (!$conn) {
    die("Error al conectar a la base de datos.<br>");
}

try {
    // Crear tabla `citas`
    $sql = "CREATE TABLE IF NOT EXISTS `citas` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `fecha` date NOT NULL,
                `hora` time NOT NULL,
                `motivo` varchar(50) NOT NULL,
                `lugar` varchar(30) NOT NULL,
                `id_cliente` bigint(20) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `id` (`id`),
                FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=23;";

    $conn->exec($sql);
    echo "Tabla 'citas' creada exitosamente<br>";

    // Crear tabla `clientes`
    $sql = "CREATE TABLE IF NOT EXISTS `clientes` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `nombre` varchar(15) NOT NULL,
                `apellidos` varchar(30) NOT NULL,
                `direccion` varchar(50) NOT NULL,
                `telefono1` varchar(9) NOT NULL,
                `telefono2` varchar(9) DEFAULT NULL,
                `nombre_usuario` varchar(20) NOT NULL,
                `pass` varchar(255) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `id` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18;";

    $conn->exec($sql);
    echo "Tabla 'clientes' creada exitosamente<br>";

    // Crear tabla `inmuebles`
    $sql = "CREATE TABLE IF NOT EXISTS `inmuebles` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `direccion` varchar(50) NOT NULL,
                `descripcion` varchar(1500) NOT NULL,
                `precio` decimal(12,2) NOT NULL,
                `id_cliente` bigint(20) NOT NULL,
                `imagen` varchar(100) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `id` (`id`),
                FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=20;";

    $conn->exec($sql);
    echo "Tabla 'inmuebles' creada exitosamente<br>";

    // Insertar datos en la tabla `citas`
    $sql = "INSERT INTO `citas` (`id`, `fecha`, `hora`, `motivo`, `lugar`, `id_cliente`) VALUES
    (11, '2017-12-13', '11:22:00', 'Entrega llaves piso', 'C/ tortola, 44', 3),
    (15, '2018-01-22', '17:00:00', 'Ver chalet', 'Carretera de la Sierra, 12', 15);";

    $conn->exec($sql);

    // Insertar datos en la tabla `clientes`
    $sql = "INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nombre_usuario`, `pass`) VALUES
    (1, 'administrador', 'administrador', 'administrador', '111111111', '', 'admin', '" . password_hash('admin', PASSWORD_BCRYPT) . "'),
    (2, 'Marisa', 'Perez Martínez', 'Av. Nueva, 123', '611622633', NULL, 'marisa', '" . password_hash('1234', PASSWORD_BCRYPT) . "');";

    $conn->exec($sql);

    // Insertar datos en la tabla `inmuebles`
    $sql = "INSERT INTO `inmuebles` (`id`, `direccion`, `descripcion`, `precio`, `id_cliente`, `imagen`) VALUES
    (7, 'Carretera de la sierra, 24', 'Chalet totalmente reformado', '99000.00', 15, './img_inmuebles/7.png');";

    $conn->exec($sql);
    echo "Datos insertados correctamente.<br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
