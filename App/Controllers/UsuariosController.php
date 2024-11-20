<?php

namespace App\Controllers;

use Core\View;
use App\Models\Usuario;
use App\Models\Propiedad;
use App\Models\Cita;
use Core\Session;

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
            // Verificar que las contraseñas coincidan
            if ($_POST['contraseña'] !== $_POST['confirmar_contraseña']) {
                header('Location: /register?error=Las contraseñas no coinciden');
                exit;
            }
            // Crear un nuevo usuario con los datos del formulario
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo_electronico' => $_POST['correo_electronico'],
                'contraseña' => password_hash($_POST['contraseña'], PASSWORD_DEFAULT),
                'telefono' => $_POST['telefono'],
                'rol' => $_POST['rol']
            ];

            // Llamar a la función correspondiente según el rol
            switch ($data['rol']) {
                case 'cliente':
                    Usuario::createCliente($data);
                    break;
                case 'agente':
                    Usuario::createAgente($data);
                    break;
                case 'admin':
                    Usuario::createAdmin($data);
                    break;
            }

            $this->redirectToProfile();
        }
    }

    public function edit($id)
    {
        // Buscar el usuario por su ID
        $usuarioToEdit = Usuario::find($id);

        $this->redirectToProfile($usuarioToEdit, null, 'usuarios');
    }

    // Método que maneja la actualización de un usuario
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Buscar el usuario por su ID
            $usuarioToEdit = Usuario::find($_POST['id']);
            
            $data = [
                'id_usuario' => $_POST['id'], // Debe coincidir con el parámetro :id_usuario
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo_electronico' => $_POST['correo_electronico'],
                'telefono' => $_POST['telefono'],
                'contraseña' => empty($_POST['contraseña']) ? $usuarioToEdit->contraseña : password_hash($_POST['contraseña'], PASSWORD_DEFAULT),
                'rol' => $_POST['rol']
            ];

            Usuario::update($data);

            $this->redirectToProfile(null, null, 'usuarios');
        }
    }

    // Método que maneja la eliminación de un usuario
    public function delete()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener el ID del usuario desde el formulario
            $id = $_POST['id'];
            // Eliminar el usuario por su ID
            Usuario::delete($id);

            $this->redirectToProfile(null, null, 'usuarios');
        }
    }

    private function redirectToProfile($usuarioToEdit = null, $propiedadToEdit = null, $activeTab = 'usuarios')
    {
        $usuarios = Usuario::all();
        $propiedades = Propiedad::all();
        $citas = Cita::all();

        $views = ['usuarios/profile/admin/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => Session::getInstance()->get('nombre'),
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'usuarioToEdit' => $usuarioToEdit,
            'propiedadToEdit' => $propiedadToEdit,
            'activeTab' => $activeTab
        ];

        View::render($views, $args);
    }
}
