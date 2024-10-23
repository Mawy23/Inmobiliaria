<?php
namespace App\Model;

use Core\Model;

class Inmueble extends Model
{
    protected $table = 'inmuebles';

    public static function buscarInmueble($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM inmuebles WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function crearInmueble($direccion, $precio, $descripcion)
    {
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO inmuebles (direccion, precio, descripcion) VALUES (:direccion, :precio, :descripcion)');
        $stmt->bindValue(':direccion', $direccion);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public static function borrarInmueble($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('DELETE FROM inmuebles WHERE id = :id');
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
