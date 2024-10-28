<?php
namespace App\Models;

use PDO;

class Cita {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=inmobiliaria", "root", "");
    }

    // Obtener citas por inmueble
    public function getCitasByInmueble($inmuebleId) {
        $sql = "SELECT * FROM citas WHERE inmueble_id = :inmueble_id";
        $query = $this->db->prepare($sql);
        $query->execute(['inmueble_id' => $inmuebleId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener citas por usuario
    public function getCitasByUsuario($usuarioId) {
        $sql = "SELECT * FROM citas WHERE usuario_id = :usuario_id";
        $query = $this->db->prepare($sql);
        $query->execute(['usuario_id' => $usuarioId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva cita
    public function crearCita($fecha, $hora, $inmuebleId, $usuarioId) {
        $sql = "INSERT INTO citas (fecha, hora, inmueble_id, usuario_id) VALUES (:fecha, :hora, :inmueble_id, :usuario_id)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'fecha' => $fecha,
            'hora' => $hora,
            'inmueble_id' => $inmuebleId,
            'usuario_id' => $usuarioId
        ]);
    }

    // Modificar una cita
    public function modificarCita($idCita, $fecha, $hora) {
        $sql = "UPDATE citas SET fecha = :fecha, hora = :hora WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'fecha' => $fecha,
            'hora' => $hora,
            'id' => $idCita
        ]);
    }

    // Eliminar una cita
    public function eliminarCita($idCita) {
        $sql = "DELETE FROM citas WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $idCita]);
    }
}
?>
