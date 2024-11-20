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
            // Conectarse a la base de datos usando PDO
            $db = static::getDB();

            // Preparar la consulta SQL con signos de interrogación en lugar de nombres de parámetros
            $stmt = $db->prepare('
            UPDATE citas 
            SET id_propiedad = ?, 
                id_cliente = ?, 
                fecha_hora = ?, 
                estado = ?
            WHERE id_cita = ?');

            // Ejecutar la consulta pasando un array con los valores en el orden correcto
            $stmt->execute([
                $data['id_propiedad'],
                $data['id_cliente'],
                $data['fecha_hora'],
                $data['estado'],
                $data['id']
            ]);
        } catch (PDOException $e) {
            // Imprimir mensaje de error detallado
            echo 'Error al actualizar el usuario: ' . $e->getMessage();
            exit;
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

    public static function find($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM citas WHERE id_cita = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject('App\Models\Cita');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function where($column, $value) {
        $sql = "SELECT * FROM citas WHERE $column = :value";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
