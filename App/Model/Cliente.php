<?php
namespace App\Models;

use Core\Model;

class Cliente extends Model {
    public function getAll() {
        $sql = "SELECT * FROM clientes";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addCliente($data) {
        $sql = "INSERT INTO clientes (nombre, apellidos, direccion, telefono1, telefono2, nombre_usuario, pass) VALUES (:nombre, :apellidos, :direccion, :telefono1, :telefono2, :nombre_usuario, :pass)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}
?>
