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

    public static function search($id_propiedad) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM imagenes WHERE id_propiedad = :id_propiedad');
            $stmt->bindParam(':id_propiedad', $id_propiedad, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Imagen');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function find($id_imagen) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT imagen FROM imagenes WHERE id_imagen = :id_imagen');
            $stmt->bindParam(':id_imagen', $id_imagen, PDO::PARAM_INT);
            $stmt->execute();
            $imagen = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $imagen['imagen']; // Retorna la URL completa de la imagen
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    

    public static function create($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO imagenes (id_propiedad, imagen, descripcion) VALUES (:id_propiedad, :imagen, :descripcion)'); //! REVISA ESTO, NO QUEREMOS DESCRIPCION 
            $stmt->bindParam(':id_propiedad', $data['id_propiedad'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $data['imagen'], PDO::PARAM_LOB);
            $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            
            // Dividir la imagen en partes más pequeñas si es necesario
            $chunkSize = 1024 * 1024; // 1MB
            $imagenData = $data['imagen'];
            $offset = 0;
            while ($offset < strlen($imagenData)) {
                $chunk = substr($imagenData, $offset, $chunkSize);
                $stmt->bindParam(':imagen', $chunk, PDO::PARAM_LOB);
                $stmt->execute();
                $offset += $chunkSize;
            }
            
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
