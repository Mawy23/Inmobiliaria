<?php
namespace App\Controllers;

use App\Models\Cita;

class CitasController {
    protected $citaModel;

    public function __construct() {
        $this->citaModel = new Cita();
        session_start();
    }

    // Ver citas por inmueble
    public function verCitasInmueble($idInmueble) {
        $citas = $this->citaModel->getCitasByInmueble($idInmueble);
        return $citas;
    }

    // Ver mis citas (para el usuario logueado)
    public function verMisCitas() {
        $idUsuario = $_SESSION['id_usuario'] ?? null;
        if ($idUsuario) {
            $citas = $this->citaModel->getCitasByUsuario($idUsuario);
            return $citas;
        } else {
            return null;
        }
    }

    // Crear una nueva cita
    public function crearCita() {
        if (isset($_POST['crear_cita'])) {
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $inmuebleId = $_POST['inmueble_id'];
            $usuarioId = $_SESSION['id_usuario'];

            $this->citaModel->crearCita($fecha, $hora, $inmuebleId, $usuarioId);

            echo "<div class='alert alert-success'>Cita creada con éxito.</div>";
        }
    }

    // Modificar una cita existente
    public function modificarCita($idCita) {
        if (isset($_POST['modificar_cita'])) {
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            $this->citaModel->modificarCita($idCita, $fecha, $hora);

            echo "<div class='alert alert-success'>Cita modificada con éxito.</div>";
        }
    }

    // Eliminar una cita
    public function eliminarCita($idCita) {
        if (isset($_POST['eliminar_cita'])) {
            $this->citaModel->eliminarCita($idCita);
            echo "<div class='alert alert-success'>Cita eliminada con éxito.</div>";
        }
    }
}
?>
