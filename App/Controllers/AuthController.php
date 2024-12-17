<?php

namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\Usuario;
use App\Models\Propiedad;
use App\Models\Imagen;


class AuthController
{
    // Método que muestra el formulario de registro
    public function register()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['usuarios/register'];
        $args  = ['title' => 'Registro'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja el registro de un nuevo usuario
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verificar que las contraseñas coincidan
            if ($_POST['contraseña'] !== $_POST['confirmar_contraseña']) {
                header('Location: /register?error=Las contraseñas no coinciden');
                exit;
            }
            // Validar los datos de entrada
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $correo_electronico = $_POST['correo_electronico'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';
            $telefono = $_POST['telefono'] ?? '';

            // Asegurarse de que los campos no estén vacíos
            if (empty($nombre) || empty($apellido) ||  empty($correo_electronico) || empty($contraseña)) {
                header('Location: /register?error=Todos los campos son obligatorios');
                exit;
            }

            // Verificar si el usuario ya existe
            $usuario = Usuario::findByEmail($correo_electronico);
            if ($usuario) {
                header('Location: /register?error=El correo electrónico ya está registrado');
                exit;
            }
            // Crear un nuevo usuario
            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo_electronico' => $correo_electronico,
                'contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
                'telefono' => $telefono
            ];
            $usuario = Usuario::createCliente($data);


            // Redirigir al inicio de sesión después del registro exitoso 
            // Definir la vista y los argumentos a pasar
            $views = ['usuarios/login'];
            $args  = ['title' => 'Login'];

            // Renderizar la vista con los argumentos
            View::render($views, $args);
        }
    }

    // Método que maneja el registro de un nuevo usuario
    public function adminStore()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar los datos de entrada
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $correo_electronico = $_POST['correo_electronico'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';
            $telefono = $_POST['telefono'] ?? '';

            // Asegurarse de que los campos no estén vacíos
            if (empty($nombre) || empty($apellido) ||  empty($correo_electronico) || empty($contraseña)) {
                header('Location: /register?error=Todos los campos son obligatorios');
                exit;
            }

            // Verificar si el usuario ya existe
            $usuario = Usuario::findByEmail($correo_electronico);
            if ($usuario) {
                header('Location: /register?error=El correo electrónico ya está registrado');
                exit;
            }
            // Crear un nuevo usuario
            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo_electronico' => $correo_electronico,
                'contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
                'telefono' => $telefono
            ];
            $usuario = Usuario::createCliente($data);


            // Redirigir al inicio de sesión después del registro exitoso 
            // Definir la vista y los argumentos a pasar
            $views = ['admin/usuarios'];
            $args  = ['title' => 'Lista'];

            // Renderizar la vista con los argumentos
            View::render($views, $args);
        }
    }


    // Método que muestra el formulario de inicio de sesión
    public function login()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['usuarios/login'];
        $args  = ['title' => 'Iniciar Sesión'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja el inicio de sesión de un usuario
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturar el correo electrónico y la contraseña del formulario
            $correo_electronico = $_POST['correo_electronico'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';

            // Verificar que los campos no estén vacíos
            if (empty($correo_electronico) || empty($contraseña)) {
                header('Location: /login?error=Todos los campos son obligatorios');
                exit;
            }

            // Buscar el usuario por su correo electrónico
            $usuario = Usuario::findByEmail($correo_electronico);

            // Verificar si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($contraseña, $usuario->contraseña)) {
                $session = Session::getInstance();
                $session->set('id_usuario', $usuario->id_usuario);
                $session->set('nombre', $usuario->nombre);
                $session->set('rol', $usuario->rol);

                // Obtener todas las propiedades de la base de datos
                $propiedades = Propiedad::all();

                // Crear un arreglo para almacenar las propiedades con sus imágenes
                $propiedadesConDatos = [];

                // Iterar sobre las propiedades para asociar imágenes
                foreach ($propiedades as $propiedad) {
                    $imagenes = Imagen::search($propiedad->id_propiedad); // Buscar imágenes por id_propiedad

                    // Asociar la propiedad con sus imágenes
                    $propiedadesConDatos[] = [
                        'propiedad' => $propiedad,
                        'imagenes' => $imagenes
                    ];
                }

                // Ordenar propiedades por precio descendente
                usort($propiedadesConDatos, function ($a, $b) {
                    return $b['propiedad']->precio <=> $a['propiedad']->precio;
                });

                // Tomar las tres primeras propiedades con mayor precio
                $propiedadesConDatos = array_slice($propiedadesConDatos, 0, 3);

                // Redirigir al inicio de sesión después del registro exitoso 
                // Definir la vista y los argumentos a pasar
                $views = ['home/index'];
                $args  = ['title' => 'home', 'propiedadesConDatos' => $propiedadesConDatos];

                // Renderizar la vista con los argumentos
                View::render($views, $args);
            } else {
                // Redireccionar con un mensaje de error si las credenciales son incorrectas
                $error_message = $usuario ? 'Credenciales incorrectas' : 'Usuario no encontrado. Por favor, inténtelo de nuevo.';
                header('Location: /login?error=' . urlencode($error_message));
                exit;
            }
        }
    }


    // Método que maneja el cierre de sesión
    public function logout()
    {
        $session = Session::getInstance();
        $session->remove('id_usuario');
        $session->remove('nombre');
        $session->remove('rol');
        session_unset(); // Libera todas las variables de sesión
        $session->destroy(); // Destruye la sesión

        // Redirigir al home después del cierre de sesión
        // Definir la vista y los argumentos a pasar
        $views = ['home/index'];
        $args  = ['title' => 'home'];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }
}
