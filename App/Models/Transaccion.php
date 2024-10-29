<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Transaccion extends Model {
    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM transacciones');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Transaccion');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO transacciones (id_propiedad, id_cliente, tipo, monto) VALUES (:id_propiedad, :id_cliente, :tipo, :monto)');
            $stmt->bindParam(':id_propiedad', $data['id_propiedad'], PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':tipo', $data['tipo'], PDO::PARAM_STR);
            $stmt->bindParam(':monto', $data['monto'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM transacciones WHERE id_transaccion = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
