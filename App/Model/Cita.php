<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Cita extends Model {
    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM citas');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Cita');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO citas (id_propiedad, id_cliente, fecha_hora, estado) VALUES (:id_propiedad, :id_cliente, :fecha_hora, :estado)');
            $stmt->bindParam(':id_propiedad', $data['id_propiedad'], PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':fecha_hora', $data['fecha_hora'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('UPDATE citas SET estado = :estado WHERE id_cita = :id');
            $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM citas WHERE id_cita = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
