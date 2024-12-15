<?php

// Definimos el espacio de nombres 'App\Controllers' para organizar los controladores de la aplicación
namespace App\Controllers;

// Usamos la clase 'View' del namespace 'Core' para gestionar la visualización de las vistas

use App\Models\Cita;
use Core\View;
use App\Models\Propiedad;
use App\Models\Usuario;
use App\Models\Tasacion;
use Core\Session;
use App\Controllers\FavoritosController;

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
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $rol = $session->get('rol');
        $citas = $rol === 'admin' ? Cita::all() : Cita::where('id_agente', $session->get('id_usuario'));
        // Definimos la vista a cargar (en este caso, 'home/example_with_args')
        $views = ['admin/citas'];

        // Definimos los argumentos a pasar a la vista, incluyendo el ID recibido como parámetro
        // Si no se pasa un ID, se asigna el valor 'No se envio ID' por defecto
        $args  = ['title' => 'Citas', 'citas' => $citas];

        // Renderizamos la vista con los argumentos
        View::render($views, $args);
    }

    public function profile()
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $rol = $session->get('rol');
        $nombre = $session->get('nombre');
        $usuarios = $rol !== 'cliente' ? Usuario::all() : []; // Obtener todos los usuarios si no es cliente
        $propiedades = $rol !== 'cliente' ? Propiedad::all() : Propiedad::where('id_agente', $session->get('id')); // Obtener todas las propiedades o las del cliente
        $citas = Cita::all(); // Obtener todas las citas
        $agentes = $rol === 'admin' ? Usuario::where('rol', 'agente') : []; // Obtener todos los agentes solo si es admin
        $favoritosController = new FavoritosController();
        $favoritos = $rol === 'cliente' ? $favoritosController->getFavoritos() : []; // Obtener los favoritos del cliente
        $tasaciones = Tasacion::all(); // Obtener todas las tasaciones

        $totalUsuarios = count($usuarios);
        $totalAdmins = count(array_filter($usuarios, fn($u) => $u->rol === 'admin'));
        $totalAgentes = count(array_filter($usuarios, fn($u) => $u->rol === 'agente'));
        $totalClientes = count(array_filter($usuarios, fn($u) => $u->rol === 'cliente'));

        $totalPropiedades = count($propiedades);
        $propiedadesDisponibles = count(array_filter($propiedades, fn($p) => $p->estado === 'disponible'));
        $propiedadesVendidas = count(array_filter($propiedades, fn($p) => $p->estado === 'vendido'));
        $propiedadesAlquiladas = count(array_filter($propiedades, fn($p) => $p->estado === 'alquilado'));

        $totalCitas = count($citas);
        $citasPendientes = count(array_filter($citas, fn($c) => $c->estado === 'pendiente'));
        $citasConfirmadas = count(array_filter($citas, fn($c) => $c->estado === 'confirmado'));
        $citasCanceladas = count(array_filter($citas, fn($c) => $c->estado === 'cancelado'));

        // Obtener estadísticas históricas de búsqueda
        $searchStats = Propiedad::getSearchHistoryStats();
        $searchStatsLabels = array_keys($searchStats['tipo']);
        $searchStatsData = [
            'tipo' => array_values($searchStats['tipo'])
        ];

        // Definimos las vistas a cargar (en este caso, 'usuarios/profile/profile')
        $views = ['usuarios/profile/profile'];

        // definimos la pestaña activa por defecto y para cliente la pestaña de favoritos
        $active_tab = 'usuarios';
        if ($rol === 'cliente') {
            $active_tab = 'favoritos';
        }

        // Definimos los argumentos a pasar a la vista (en este caso, el título de la página)
        $args  = [
            'title' => 'Panel de Administración',
            'nombre' => $nombre,
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'agentes' => $agentes,
            'rol' => $rol,
            'favoritos' => $favoritos,
            'tasaciones' => $tasaciones,
            'active_tab' => $active_tab,
            'totalUsuarios' => $totalUsuarios,
            'totalAdmins' => $totalAdmins,
            'totalAgentes' => $totalAgentes,
            'totalClientes' => $totalClientes,
            'totalPropiedades' => $totalPropiedades,
            'propiedadesDisponibles' => $propiedadesDisponibles,
            'propiedadesVendidas' => $propiedadesVendidas,
            'propiedadesAlquiladas' => $propiedadesAlquiladas,
            'totalCitas' => $totalCitas,
            'citasPendientes' => $citasPendientes,
            'citasConfirmadas' => $citasConfirmadas,
            'citasCanceladas' => $citasCanceladas,
            'searchStatsLabels' => $searchStatsLabels,
            'searchStatsData' => $searchStatsData
        ];

        // Renderizamos la vista con los argumentos especificados
        View::render($views, $args);
    }

}
