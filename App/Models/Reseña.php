<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Reseña extends Model {
    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM reseñas');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Reseña');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO reseñas (id_propiedad, id_cliente, calificacion, comentario) VALUES (:id_propiedad, :id_cliente, :calificacion, :comentario)');
            $stmt->bindParam(':id_propiedad', $data['id_propiedad'], PDO::PARAM_INT);
            $stmt->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':calificacion', $data['calificacion'], PDO::PARAM_INT);
            $stmt->bindParam(':comentario', $data['comentario'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM reseñas WHERE id_reseña = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
