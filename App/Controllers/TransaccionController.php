<?php
namespace App\Controllers;

use Core\View;
use App\Models\Transaccion;

class TransaccionController
{
    // Método que muestra la lista de transacciones
    public function index()
    {
        // Obtener todas las transacciones de la base de datos
        $transacciones = Transaccion::all();
        
        // Definir las vistas y los argumentos a pasar
        $views = ['transaccion/index'];
        $args  = ['title' => 'Lista de Transacciones', 'transacciones' => $transacciones];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva transacción
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['transaccion/create'];
        $args  = ['title' => 'Agregar Transacción'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva transacción
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear una nueva transacción con los datos del formulario
            Transaccion::create($_POST);
            
            // Redireccionar a la lista de transacciones
            header('Location: /transacciones');
            exit;
        }
    }

    // Método que maneja la eliminación de una transacción
    public function delete($id)
    {
        // Eliminar la transacción por su ID
        Transaccion::delete($id);
        
        // Redireccionar a la lista de transacciones
        header('Location: /transacciones');
        exit;
    }
}
