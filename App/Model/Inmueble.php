<?php
namespace App\Models;

use Core\Model;

class Inmueble extends Model {
    public function getAll() {
        $sql = "SELECT * FROM inmuebles";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addInmueble($data) {
        $sql = "INSERT INTO inmuebles (direccion, descripcion, precio, tipo, id_cliente, imagen, id_agente) VALUES (:direccion, :descripcion, :precio, :tipo, :id_cliente, :imagen, :id_agente)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}

?>
