<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Tasacion extends Model {
    // Método que obtiene todas las tasaciones de la base de datos
    public static function all() {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();

            // Preparamos la consulta SQL para obtener todas las tasaciones
            $stmt = $db->query('SELECT * FROM tasacion');

            // Obtenemos los resultados como un array de objetos de la clase Tasacion
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tasacion');

            // Devolvemos los resultados
            return $results;
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO tasacion (nombre, apellido, correo) VALUES (:nombre, :apellido, :correo)');
            $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('
            UPDATE tasacion 
            SET nombre = ?, 
                apellido = ?, 
                correo = ?
            WHERE id_tasacion = ?');
            $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['correo'],
                $data['id']
            ]);
        } catch (PDOException $e) {
            echo 'Error al actualizar la tasación: ' . $e->getMessage();
            exit;
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM tasacion WHERE id_tasacion = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function find($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM tasacion WHERE id_tasacion = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject('App\Models\Tasacion');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function where($column, $value) {
        $sql = "SELECT * FROM tasacion WHERE $column = :value";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
