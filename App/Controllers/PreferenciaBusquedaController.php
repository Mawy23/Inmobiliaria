<?php
namespace App\Controllers;

use Core\View;
use App\Models\PreferenciaBusqueda;

class PreferenciaBusquedaController
{
    // Método que muestra la lista de preferencias de búsqueda
    public function index()
    {
        // Obtener todas las preferencias de búsqueda de la base de datos
        $preferencias = PreferenciaBusqueda::all();
        
        // Definir las vistas y los argumentos a pasar
        $views = ['preferencia_busqueda/index'];
        $args  = ['title' => 'Lista de Preferencias de Búsqueda', 'preferencias' => $preferencias];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva preferencia de búsqueda
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['preferencia_busqueda/create'];
        $args  = ['title' => 'Agregar Preferencia de Búsqueda'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva preferencia de búsqueda
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva preferencia de búsqueda con los datos del formulario
            PreferenciaBusqueda::create($_POST);
            
            // Redireccionar a la lista de preferencias de búsqueda
            header('Location: /preferencias-busqueda');
            exit;
        }
    }

    // Método que maneja la eliminación de una preferencia de búsqueda
    public function delete($id)
    {
        // Eliminar la preferencia de búsqueda por su ID
        PreferenciaBusqueda::delete($id);
        
        // Redireccionar a la lista de preferencias de búsqueda
        header('Location: /preferencias-busqueda');
        exit;
    }
}
