<?php
namespace App\Models;

use Core\Model;

class Transaccion extends Model {
    public function getAll() {
        $sql = "SELECT * FROM transacciones";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addTransaccion($data) {
        $sql = "INSERT INTO transacciones (fecha, monto, tipo, id_inmueble, id_cliente) VALUES (:fecha, :monto, :tipo, :id_inmueble, :id_cliente)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }
}

?>