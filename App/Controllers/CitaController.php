<?php
namespace App\Controllers;

use Core\View;
use App\Models\Cita;

class CitaController
{
    // Método que muestra la lista de citas
    public function index()
    {
        // Obtener todas las citas de la base de datos
        $citas = Cita::all();
        
        // Definir las vistas y los argumentos a pasar
        $views = ['cita/index'];
        $args  = ['title' => 'Lista de Citas', 'citas' => $citas];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva cita
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['cita/create'];
        $args  = ['title' => 'Agregar Cita'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva cita
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva cita con los datos del formulario
            Cita::create($_POST);
            
            $views = ['admin/citas'];
            $args  = ['title' => 'citas'];

            // Renderizar la vista con los argumentos
            View::render($views, $args);
        }
    }

    // Método que maneja la eliminación de una cita
    public function delete($id)
    {
        // Eliminar la cita por su ID
        Cita::delete($id);
        
        // Redireccionar a la lista de citas
        header('Location: /citas');
        exit;
    }
}

