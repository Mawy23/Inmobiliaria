<?php
namespace App\Controllers;

use App\Models\Usuario;

class AccesoController {
    protected $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        session_start();
    }

    public function redirectIfAuthenticated() {
        if (isset($_SESSION['tipo'])) {
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../index.php'>";
            exit;
        }
    }

    public function login() {
        if (isset($_POST['acceder'])) {
            $usuario = $_POST['nick'];
            $pass = $_POST['password'];
            $md5 = md5(md5($pass));

            $userData = $this->usuarioModel->getUserByCredentials($usuario, $md5);

            if ($userData) {
                $_SESSION['id_usuario'] = $userData['id'];
                $_SESSION['tipo'] = ($usuario === 'admin') ? 'a' : 'u';
                $_SESSION['nombre'] = ($usuario === 'admin') ? 'Administrador' : $userData['nombre'] . ' ' . $userData['apellidos'];

                if (isset($_POST['check'])) {
                    $datos = session_encode();
                    setcookie('datos', $datos, time() + (15 * 24 * 60 * 60), '/');
                }

                echo "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                        <strong>¡Acceso correcto!</strong>
                      </div>";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=../index.php'>";
            } else {
                echo "<div class='container-fluid'><div class='row'><div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                        <h4><strong>¡Error!</strong> Usuario o contraseña incorrectos</h4>
                      </div></div></div>";
            }
        }
    }
}
?>
