<?php

namespace App\Controllers;

use Core\View;
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
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Asegurarse de que los campos no estén vacíos
            if (empty($nombre) || empty($email) || empty($password)) {
                // Redireccionar con un mensaje de error si hay campos vacíos
                header('Location: /register?error=Todos los campos son obligatorios');
                exit;
            }

            // Crear un nuevo usuario en la base de datos
            Usuario::create([
                'nombre' => $nombre,
                'correo_electronico' => $email, // Usar el nombre de campo correcto
                'contraseña' => password_hash($password, PASSWORD_DEFAULT) // Almacenar la contraseña de forma segura
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
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Buscar el usuario por su email
            $usuario = Usuario::findByEmail($email);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($password, $usuario['contraseña'])) {
                // Iniciar sesión del usuario, puedes guardar el ID en la sesión
                session_start();
                $_SESSION['id_usuario'] = $usuario['id_usuario']; // Suponiendo que 'id_usuario' es el campo clave primaria
                $_SESSION['nombre'] = $usuario['nombre']; // Guardar el nombre del usuario

                // Redirigir a la página principal después del inicio de sesión exitoso
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
        // Iniciar la sesión y destruirla para cerrar la sesión del usuario
        session_start();
        session_destroy();

        // Redirigir a la página de inicio después del cierre de sesión
        header('Location: /login?success=Cierre de sesión exitoso');
        exit;
    }
}
