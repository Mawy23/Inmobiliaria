<?php
namespace App\Controllers;

use Core\View;
use App\Models\Propiedad;

class PropiedadController
{
    // Método que maneja la vista de lista de propiedades
    public function index()
    {
        // Obtener todas las propiedades de la base de datos
        $propiedades = Propiedad::all();
        
        // Definir las vistas a cargar y los argumentos a pasar
        $views = ['propiedad/index'];
        $args  = ['title' => 'Lista de Propiedades', 'propiedades' => $propiedades];
        
        // Renderizar la vista con los argumentos especificados
        View::render($views, $args);
    }

    // Método que maneja la vista de detalles de una propiedad específica
    public function show($id)
    {
        // Obtener la propiedad por su ID
        $propiedad = Propiedad::find($id);
        
        // Definir la vista y los argumentos a pasar
        $views = ['propiedad/show'];
        $args  = ['title' => 'Detalles de la Propiedad', 'propiedad' => $propiedad];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva propiedad
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['propiedad/create'];
        $args  = ['title' => 'Agregar Propiedad'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva propiedad
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva propiedad con los datos del formulario
            Propiedad::create($_POST);
            
            $views = ['admin/propiedades'];
            $args  = ['title' => 'propiedades'];

            // Renderizar la vista con los argumentos
            View::render($views, $args);
        }
    }

    // Método que muestra el formulario para editar una propiedad existente
    public function edit($id)
    {
        // Obtener la propiedad por su ID
        $propiedad = Propiedad::find($id);
        
        // Definir la vista y los argumentos a pasar
        $views = ['propiedad/edit'];
        $args  = ['title' => 'Editar Propiedad', 'propiedad' => $propiedad];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la actualización de una propiedad existente
    public function update($id)
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Asegurar que el ID esté en los datos a actualizar
            $_POST['id'] = $id; 
            // Actualizar la propiedad con los nuevos datos
            Propiedad::update($_POST);
            
            // Redireccionar a la lista de propiedades
            header('Location: /propiedades');
            exit;
        }
    }

    // Método que maneja la eliminación de una propiedad
    public function delete($id)
    {
        // Eliminar la propiedad por su ID
        Propiedad::delete($id);
        
        // Redireccionar a la lista de propiedades
        header('Location: /propiedades');
        exit;
    }
}
