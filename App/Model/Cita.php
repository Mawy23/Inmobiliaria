<?php
namespace App\Models;

use Core\Model;

class Cita extends Model {
    public function getAll() {
        $sql = "SELECT * FROM citas";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addCita($data) {
        $sql = "INSERT INTO citas (fecha, hora, motivo, lugar, id_cliente, id_agente, estado) VALUES (:fecha, :hora, :motivo, :lugar, :id_cliente, :id_agente, :estado)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}

?>
