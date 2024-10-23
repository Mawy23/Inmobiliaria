<?php
namespace App\Models;

use Core\Model;

class Usuario extends Model {
    public function getAll() {
        $sql = "SELECT * FROM usuarios";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addUsuario($data) {
        $sql = "INSERT INTO usuarios (nombre_usuario, email, password, id_rol) VALUES (:nombre_usuario, :email, :password, :id_rol)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}

