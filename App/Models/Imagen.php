<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Imagen extends Model {
    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM imagenes');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Imagen');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function find($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM imagenes WHERE id_imagen = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject('App\Models\Imagen');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO imagenes (id_propiedad, url_imagen, descripcion) VALUES (:id_propiedad, :url_imagen, :descripcion)');
            $stmt->bindParam(':id_propiedad', $data['id_propiedad'], PDO::PARAM_INT);
            $stmt->bindParam(':url_imagen', $data['url_imagen'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM imagenes WHERE id_imagen = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}