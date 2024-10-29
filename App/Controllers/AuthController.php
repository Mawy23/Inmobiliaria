<?php

namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\Usuario;

class AuthController
{
    // Método que muestra el formulario de registro
    public function register()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['auth/register'];
        $args  = ['title' => 'Registro'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja el registro de un nuevo usuario
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar los datos de entrada
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $correo_electronico = $_POST['correo_electronico'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';
            $rol = $_POST['rol'] ?? 'cliente';



            // Asegurarse de que los campos no estén vacíos
            if (empty($nombre) || empty($apellido) || empty($correo_electronico) || empty($contraseña)) {
                header('Location: /register?error=Todos los campos son obligatorios');
                exit;
            }

            // Crear un nuevo usuario en la base de datos
            Usuario::create([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo_electronico' => $correo_electronico,
                'contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
                'rol' => $rol
            ]);

            // Redirigir al inicio de sesión después del registro exitoso
            header('Location: /login?success=Registro exitoso. Inicie sesión.');
            exit;
        }
    }

    // Método que muestra el formulario de inicio de sesión
    public function login()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['auth/login'];
        $args  = ['title' => 'Iniciar Sesión'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja el inicio de sesión de un usuario
    public function authenticate()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturar el email y la contraseña del formulario
            $correo_electronico = $_POST['correo_electronico'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';

            // Buscar el usuario por su email
            $usuario = Usuario::findByEmail($correo_electronico);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
                $session = Session::getInstance();
                $session->set('id_usuario', $usuario['id_usuario']);
                $session->set('nombre', $usuario['nombre']);
                $session->set('rol', $usuario['rol']);

                header('Location: /home');
                exit;
            } else {
                // Redireccionar con un mensaje de error si las credenciales son incorrectas
                header('Location: /login?error=Credenciales incorrectas');
                exit;
            }
        }
    }

    // Método que maneja el cierre de sesión
    public function logout()
    {
        // Cerrar la sesión
        $session = Session::getInstance();
        $session->destroy();

        // Redirigir al login
        header('Location: /login');
        exit;
    }
}
