<?php   
namespace App\Controllers;

use Core\View;
use App\Models\Reseña;

class ReseñaController
{
    // Método que muestra la lista de reseñas
    public function index()
    {
        // Obtener todas las reseñas de la base de datos
        $reseñas = Reseña::all();
        
        // Definir las vistas y los argumentos a pasar
        $views = ['reseña/index'];
        $args  = ['title' => 'Lista de Reseñas', 'reseñas' => $reseñas];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva reseña
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['reseña/create'];
        $args  = ['title' => 'Agregar Reseña'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva reseña
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva reseña con los datos del formulario
            Reseña::create($_POST);
            
            // Redireccionar a la lista de reseñas
            header('Location: /reseñas');
            exit;
        }
    }

    // Método que maneja la eliminación de una reseña
    public function delete($id)
    {
        // Eliminar la reseña por su ID
        Reseña::delete($id);
        
        // Redireccionar a la lista de reseñas
        header('Location: /reseñas');
        exit;
    }
}
