<?php
namespace App\Controllers;

use App\Models\Usuario;

class UsuariosController {
    protected $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        session_start();
    }

    // Registrar un nuevo usuario
    public function registrarUsuario() {
        if (isset($_POST['registrar_usuario'])) {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $this->usuarioModel->registrarUsuario($nombre, $email, $password);
            echo "<div class='alert alert-success'>Usuario registrado con éxito.</div>";
        }
    }

    // Iniciar sesión
    public function iniciarSesion() {
        if (isset($_POST['iniciar_sesion'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = $this->usuarioModel->getUsuarioByEmail($email);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['id_usuario'] = $usuario['id'];
                echo "<div class='alert alert-success'>Sesión iniciada con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>Correo o contraseña incorrectos.</div>";
            }
        }
    }

    // Cerrar sesión
    public function cerrarSesion() {
        session_destroy();
        echo "<div class='alert alert-success'>Sesión cerrada con éxito.</div>";
    }

    // Ver perfil del usuario actual
    public function verPerfil() {
        $idUsuario = $_SESSION['id_usuario'] ?? null;
        if ($idUsuario) {
            $usuario = $this->usuarioModel->getUsuarioById($idUsuario);
            return $usuario;
        } else {
            return null;
        }
    }
}
?>
