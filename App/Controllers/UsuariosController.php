<?php

namespace App\Controllers;

use Core\View;
use App\Models\Usuario;

class UsuariosController
{
    // Método que muestra la lista de usuarios
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        $usuarios = Usuario::all();

        // Definir las vistas y los argumentos a pasar
        $views = ['usuarios/index'];
        $args  = ['title' => 'Lista de Usuarios', 'usuarios' => $usuarios];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar un nuevo usuario
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['usuarios/create'];
        $args  = ['title' => 'Agregar Usuario'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de un nuevo usuario
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Crear un nuevo usuario con los datos del formulario
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo_electronico' => $_POST['correo_electronico'],
                'contraseña' => password_hash($_POST['contraseña'], PASSWORD_DEFAULT),
                'telefono' => $_POST['telefono']
            ];

            Usuario::create($data);

            $views = ['admin/usuarios'];
            $args  = ['title' => 'Lista de Usuarios', 'usuarios' => Usuario::all()];

            // Renderizar la vista con los argumentos
            View::render($views, $args);
        }
    }

    public function edit($id)
    {
        // Buscar el usuario por su ID
        $usuarioToEdit = Usuario::find($id);

        $views = ['admin/usuarios'];
        $args  = [
            'title' => 'Lista de Usuarios',
            'usuarios' => Usuario::all(),
            'usuarioToEdit' => $usuarioToEdit
        ];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la actualización de un usuario
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_usuario' => $_POST['id'], // Debe coincidir con el parámetro :id_usuario
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo_electronico' => $_POST['correo_electronico'],
                'telefono' => $_POST['telefono'],
                'contraseña' => empty($_POST['contraseña']) ? $_POST['contraseña'] : password_hash($_POST['contraseña'], PASSWORD_DEFAULT),
                'rol' => $_POST['rol']
            ];

            Usuario::update($data);

            // Redirigir a la lista de usuarios después de la actualización
            $views = ['admin/usuarios'];
            $args  = ['title' => 'Lista de Usuarios', 'usuarios' => Usuario::all()];

            View::render($views, $args);
        }
    }

    // Método que maneja la eliminación de un usuario
    public function delete()
    {

        // Obtener el ID del usuario desde el formulario
        $id = $_POST['id'];
        // Eliminar el usuario por su ID
        Usuario::delete($id);

        $views = ['admin/usuarios'];
        $args  = ['title' => 'Lista de Usuarios', 'usuarios' => Usuario::all()];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }
}
