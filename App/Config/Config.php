<?php

// Definimos el espacio de nombres 'App\Config' para organizar la configuración de la aplicación
namespace App\Config;

// Definimos la clase 'Config' que contendrá las constantes de configuración de la base de datos
class Config
{
    
    const DB_HOST    = 'localhost';

    // Puerto de la base de datos (puede dejarse vacío si se utiliza el puerto por defecto)
    const DB_PORT    = '';

    // Nombre de la base de datos a la que se quiere conectar
    const DB_NAME    = 'inmobiliaria';

    // Usuario con permisos para acceder a la base de datos
    const DB_USER    = 'root';

    // Contraseña del usuario para la conexión a la base de datos
    const DB_PASS    = '';

    // Conjunto de caracteres que utilizará la base de datos (en este caso, utf8mb4 es una versión más completa de utf8)
    const DB_CHARSET = 'utf8mb4';
}
