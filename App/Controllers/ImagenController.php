<?php
namespace App\Controllers;

use Core\View;
use App\Models\Imagen;
use App\Models\Propiedad;

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

    public function show($id_imagen)
    {
        // Obtener la URL de la imagen por su ID
        $url_imagen = Imagen::find($id_imagen);

        if ($url_imagen) {
            // Definir las vistas y los argumentos a pasar
            $views = ['propiedades/listado'];
            $args  = ['title' => 'Detalles de la Imagen', 'url_imagen' => $url_imagen];

            // Renderizar la vista con la URL de la imagen
            View::render($views, $args);
        } else {
            // Error: imagen no encontrada
            echo 'Error: No se encontró la imagen.';
        }
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
