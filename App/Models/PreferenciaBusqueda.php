<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class PreferenciaBusqueda extends Model {
    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM preferencias_busqueda');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\PreferenciaBusqueda');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO preferencias_busqueda (id_cliente, tipo_propiedad, rango_precio_min, rango_precio_max, localizacion) VALUES (:id_cliente, :tipo_propiedad, :rango_precio_min, :rango_precio_max, :localizacion)');
            $stmt->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':tipo_propiedad', $data['tipo_propiedad'], PDO::PARAM_STR);
            $stmt->bindParam(':rango_precio_min', $data['rango_precio_min'], PDO::PARAM_STR);
            $stmt->bindParam(':rango_precio_max', $data['rango_precio_max'], PDO::PARAM_STR);
            $stmt->bindParam(':localizacion', $data['localizacion'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM preferencias_busqueda WHERE id_preferencia = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
