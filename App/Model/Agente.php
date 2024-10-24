<?php
namespace App\Models;

use Core\Model;

class Agente extends Model {
    public function getAll() {
        $sql = "SELECT * FROM agentes";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addAgente($data) {
        $sql = "INSERT INTO agentes (nombre, apellidos, telefono, email, id_usuario) VALUES (:nombre, :apellidos, :telefono, :email, :id_usuario)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}
?>
