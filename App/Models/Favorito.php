<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Favorito extends Model
{
    protected static $table = 'favoritos';

    public $id_favorito;
    public $id_cliente;
    public $id_propiedad;

    public static function all()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM " . static::$table);
            return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function find($id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM " . static::$table . " WHERE id_favorito = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject(static::class);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function where($column, $value)
    {
        $sql = "SELECT * FROM favoritos WHERE $column = :value";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Favorito');
    }

    public static function first($id_cliente, $id_propiedad)
    {
        $sql = "SELECT * FROM favoritos WHERE id_cliente = :id_cliente AND id_propiedad = :id_propiedad LIMIT 1";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':id_propiedad', $id_propiedad);
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public function save()
    {
        $sql = "INSERT INTO favoritos (id_cliente, id_propiedad) VALUES (:id_cliente, :id_propiedad)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':id_cliente', $this->id_cliente);
        $stmt->bindValue(':id_propiedad', $this->id_propiedad);
        $stmt->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM favoritos WHERE id_cliente = :id_cliente AND id_propiedad = :id_propiedad";
        $stmt = self::getDB()->prepare($sql);
        $stmt->bindValue(':id_cliente', $this->id_cliente);
        $stmt->bindValue(':id_propiedad', $this->id_propiedad);
        $stmt->execute();
    }
}