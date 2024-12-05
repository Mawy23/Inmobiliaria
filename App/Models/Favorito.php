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
        try {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM " . static::$table . " WHERE $column = :value");
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function save()
    {
        if (empty($this->id_cliente) || empty($this->id_propiedad)) {
            throw new Exception("Los campos id_cliente y id_propiedad son requeridos y no pueden estar vacíos.");
        }

        try {
            $db = static::getDB();
            if (isset($this->id_favorito)) {
                $stmt = $db->prepare("UPDATE " . static::$table . " SET id_cliente = :id_cliente, id_propiedad = :id_propiedad WHERE id_favorito = :id_favorito");
                $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
                $stmt->bindParam(':id_propiedad', $this->id_propiedad, PDO::PARAM_INT);
                $stmt->bindParam(':id_favorito', $this->id_favorito, PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare("INSERT INTO " . static::$table . " (id_cliente, id_propiedad) VALUES (:id_cliente, :id_propiedad)");
                $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
                $stmt->bindParam(':id_propiedad', $this->id_propiedad, PDO::PARAM_INT);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function delete($id)
    {
        try {
            $db = static::getDB();
            $stmt = $db->prepare("DELETE FROM " . static::$table . " WHERE id_favorito = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}