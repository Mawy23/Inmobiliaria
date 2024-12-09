<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Propiedad extends Model {

    // Asegúrate de que la propiedad id_propiedad esté definida
    public $id_propiedad;

    // Definir la propiedad isFavorito
    public $isFavorito = false;

    public static function all() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM propiedades');
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Propiedad');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function find($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('SELECT * FROM propiedades WHERE id_propiedad = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject('App\Models\Propiedad');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function create($data) {
        try {
            // Validar que todos los campos requeridos están presentes
            $requiredFields = ['titulo', 'descripcion', 'precio', 'tipo', 'direccion', 'ciudad', 'estado', 'codigo_postal'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    throw new Exception("El campo $field es requerido y no puede estar vacío.");
                }
            }

            $db = static::getDB();
            $stmt = $db->prepare('INSERT INTO propiedades (titulo, descripcion, precio, tipo, direccion, ciudad, estado, codigo_postal, id_agente) VALUES (:titulo, :descripcion, :precio, :tipo, :direccion, :ciudad, :estado, :codigo_postal, :id_agente)');
            $stmt->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $data['tipo'], PDO::PARAM_STR);
            $stmt->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
            $stmt->bindParam(':ciudad', $data['ciudad'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':codigo_postal', $data['codigo_postal'], PDO::PARAM_STR);
            $stmt->bindValue(':id_agente', $data['id_agente'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function update($data) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('UPDATE propiedades SET titulo = :titulo, descripcion = :descripcion, precio = :precio, tipo = :tipo, direccion = :direccion, ciudad = :ciudad, estado = :estado, codigo_postal = :codigo_postal, id_agente = :id_agente WHERE id_propiedad = :id');
            $stmt->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $data['tipo'], PDO::PARAM_STR);
            $stmt->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
            $stmt->bindParam(':ciudad', $data['ciudad'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':codigo_postal', $data['codigo_postal'], PDO::PARAM_STR);
            $stmt->bindParam(':id_agente', $data['id_agente'], PDO::PARAM_INT);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id) {
        try {
            $db = static::getDB();
            $stmt = $db->prepare('DELETE FROM propiedades WHERE id_propiedad = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function search($tipo = null, $precio_min = null, $precio_max = null, $ciudad = null) {
        try {
            $db = static::getDB();
            $query = 'SELECT * FROM propiedades WHERE 1=1';
            $params = [];
    
            if ($tipo) {
                $query .= ' AND tipo = :tipo';
                $params[':tipo'] = $tipo;
            }
    
            if ($precio_min) {
                $query .= ' AND precio >= :precio_min';
                $params[':precio_min'] = $precio_min;
            }
    
            if ($precio_max) {
                $query .= ' AND precio <= :precio_max';
                $params[':precio_max'] = $precio_max;
            }
    
            if ($ciudad) {
                $query .= ' AND ciudad LIKE :ciudad';
                $params[':ciudad'] = '%' . $ciudad . '%';
            }
    
            $stmt = $db->prepare($query);
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Propiedad');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function where($column, $value)
    {
        $sql = "SELECT * FROM propiedades WHERE $column = :value";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function isFavorito($id_cliente)
    {
        $sql = "SELECT COUNT(*) FROM favoritos WHERE id_cliente = :id_cliente AND id_propiedad = :id_propiedad";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(':id_propiedad', $this->id_propiedad, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}

$propiedades = Propiedad::all(); // Obtener todas las propiedades o las del cliente

