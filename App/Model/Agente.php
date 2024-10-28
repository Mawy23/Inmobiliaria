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

    public function deleteAgente($id){
        $sql = "DELETE FROM agentes WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }

    public function getAgenteById($id){
        $sql = "SELECT * FROM agentes WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function updateAgente($data){
        $sql = "UPDATE agentes SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, email = :email, id_usuario = :id_usuario WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}
