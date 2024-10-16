<?php

// Definimos el espacio de nombres 'Core' para organizar la estructura del core de la aplicación
namespace Core;

class Util
{
    // Método estático para obtener la URL base de la aplicación
    public static function baseUrl()
    {
        // Comprobamos si la conexión es segura (HTTPS) y establecemos el esquema apropiado ('https' o 'http')
        $baseUrl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');

        // Añadimos el nombre del host (dominio o IP) a la URL base
        $baseUrl .= '://'.$_SERVER['HTTP_HOST'];

        // Añadimos el nombre del script principal, eliminando el nombre del archivo al final
        $baseUrl .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        // Eliminamos el nombre de la carpeta pública de la URL, si es necesario
        $baseUrl = str_replace(PUBLIC_FOLDER.'/', '', $baseUrl);

        // Retornamos la URL base completa
        return $baseUrl;
    }
}
