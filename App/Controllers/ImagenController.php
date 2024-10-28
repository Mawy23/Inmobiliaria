<?php
namespace App\Controllers;

use Core\View;
use App\Models\Imagen;

class ImagenController
{
    // Método que muestra la lista de imágenes
    public function index()
    {
        // Obtener todas las imágenes de la base de datos
        $imagenes = Imagen::all();
        
        // Definir las vistas y los argumentos a pasar
        $views = ['imagen/index'];
        $args  = ['title' => 'Lista de Imágenes', 'imagenes' => $imagenes];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva imagen
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['imagen/create'];
        $args  = ['title' => 'Agregar Imagen'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva imagen
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva imagen con los datos del formulario
            Imagen::create($_POST);
            
            // Redireccionar a la lista de imágenes
            header('Location: /imagenes');
            exit;
        }
    }

    // Método que maneja la eliminación de una imagen
    public function delete($id)
    {
        // Eliminar la imagen por su ID
        Imagen::delete($id);
        
        // Redireccionar a la lista de imágenes
        header('Location: /imagenes');
        exit;
    }
}
