<?php

// Definimos el espacio de nombres 'App\Controllers' para organizar los controladores de la aplicación
namespace App\Controllers;

// Usamos la clase 'View' del namespace 'Core' para gestionar la visualización de las vistas
use Core\View;
use App\Models\Propiedad;

// Definimos la clase 'Home' que manejará la lógica de las páginas relacionadas con el "Home"
class Home
{
    // Método que maneja la vista principal del "Home"
    public function index()
    {
        // Definimos las vistas a cargar (en este caso, 'home/index')
        $views = ['home/index'];

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        $args  = ['title' => 'Home'];

        // Renderizamos la vista con los argumentos especificados
        View::render($views, $args);
    }

    // Método que maneja una vista de ejemplo
    public function busquedaInmuebles(){

        // Obtener todas las propiedades de la base de datos
        //$propiedades = Propiedad::all();

        // Definimos las vistas a cargar (en este caso, 'home/busqueda_inmuebles')
        //$views = ['propiedades/listado'];

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        //$args  = ['title' => 'Busqueda de Inmuebles', 'propiedades' => $propiedades];

        // Renderizamos la vista con los argumentos especificados
        //View::render($views, $args);
    }

    // Método que maneja una vista de ejemplo con parámetros adicionales
    public function exampleWithArgs($id = null)
    {
        // Definimos la vista a cargar (en este caso, 'home/example_with_args')
        $views = ['admin/usuarios'];

        // Definimos los argumentos a pasar a la vista, incluyendo el ID recibido como parámetro
        // Si no se pasa un ID, se asigna el valor 'No se envio ID' por defecto
        $args  = ['title' => 'Citas'];

        // Renderizamos la vista con los argumentos
        View::render($views, $args);
    }
}
