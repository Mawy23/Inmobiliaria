<?php

// Definimos el espacio de nombres 'App\Controllers' para organizar el código en un contexto específico
namespace App\Controllers;

// Usamos la clase 'View' que pertenece al namespace 'Core' para gestionar vistas
use Core\View;

// Definimos la clase 'Error' que se encargará de manejar los errores
class Error
{
    // Método index vacío: este método podría ser utilizado para manejar el error por defecto
    public function index()
    {
    }

    // Método pageNotFound: este método maneja específicamente los errores 404 (página no encontrada)
    public function pageNotFound()
    {
        // Establecemos el código de respuesta HTTP a 404 para indicar "Página no encontrada"
        http_response_code(404);

        // Usamos la clase 'View' para renderizar la vista 'error/404', que mostrará la página de error correspondiente
        View::render(['error/404']);
    }
}
