<?php

// Definimos el espacio de nombres 'App\Controllers' para organizar los controladores de la aplicación
namespace App\Controllers;

// Usamos la clase 'View' del namespace 'Core' para gestionar la visualización de las vistas

use App\Models\Cita;
use Core\View;
use App\Models\Propiedad;
use App\Models\Usuario;
use Core\Session;

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
    public function usuarios($id = null)
    {
        // Obtenemos todos los usuarios de la base de datos
        $usuarios = Usuario::all();
        // Definimos la vista a cargar (en este caso, 'home/example_with_args')
        $views = ['admin/usuarios'];

        // Definimos los argumentos a pasar a la vista, incluyendo el ID recibido como parámetro
        // Si no se pasa un ID, se asigna el valor 'No se envio ID' por defecto
        $args  = ['title' => 'Citas', 'usuarios' => $usuarios];

        // Renderizamos la vista con los argumentos
        View::render($views, $args);
    }

    public function propiedades($id = null)
    {
        // Obtenemos todos los usuarios de la base de datos
        $usuarios = Propiedad::all();
        // Definimos la vista a cargar (en este caso, 'home/example_with_args')
        $views = ['admin/propiedades'];

        // Definimos los argumentos a pasar a la vista, incluyendo el ID recibido como parámetro
        // Si no se pasa un ID, se asigna el valor 'No se envio ID' por defecto
        $args  = ['title' => 'Propiedades', 'propiedades' => $usuarios];

        // Renderizamos la vista con los argumentos
        View::render($views, $args);
    }

    public function citas($id = null)
    {
        // Obtenemos todos los usuarios de la base de datos
        $usuarios = Cita::all();
        // Definimos la vista a cargar (en este caso, 'home/example_with_args')
        $views = ['admin/citas'];

        // Definimos los argumentos a pasar a la vista, incluyendo el ID recibido como parámetro
        // Si no se pasa un ID, se asigna el valor 'No se envio ID' por defecto
        $args  = ['title' => 'Citas', 'citas' => $usuarios];

        // Renderizamos la vista con los argumentos
        View::render($views, $args);
    }

    public function profile()
    {
        // Obtener la sesión del administrador
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $usuarios = []; // Obtener todos los usuarios
        $propiedades = []; // Obtener todas las propiedades
        $citas = []; // Obtener todas las citas

        // Definimos las vistas a cargar (en este caso, 'usuarios/profile/admin/profile')
        $views = ['usuarios/profile/admin/profile'];

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        $args  = [
            'title' => 'Panel de Administración',
            'nombre' => $nombre,
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas
        ];

        // Renderizamos la vista con los argumentos especificados
        View::render($views, $args);
    }

    public function profileUser()
    {
        // Definimos las vistas a cargar (en este caso, 'usuarios/profileUser')
        $views = ['usuarios/profile/user/profile'];

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        $args  = ['title' => 'Perfil de Usuario'];

        // Renderizamos la vista con los argumentos especificados
        View::render($views, $args);
    }

    public function profileAgent()
    {
        // Definimos las vistas a cargar (en este caso, 'usuarios/profileAgent')
        $views = ['usuarios/profile/agent/profile'];

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        $args  = ['title' => 'Perfil de Agente'];

        // Renderizamos la vista con los argumentos especificados
        View::render($views, $args);
    }

}
