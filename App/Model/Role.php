<?php
namespace App\Models;

use Core\Model;

class Rol extends Model {
    public function getAll() {
        $sql = "SELECT * FROM roles";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addRol($data) {
        $sql = "INSERT INTO roles (nombre) VALUES (:nombre)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}
