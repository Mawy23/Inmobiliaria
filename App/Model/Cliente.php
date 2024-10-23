<?php
namespace App\Model;

use Core\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    public static function buscarCliente($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM clientes WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function crearCliente($nombre, $email, $telefono)
    {
        $db = static::getDB();
        $stmt = $db->prepare('INSERT INTO clientes (nombre, email, telefono) VALUES (:nombre, :email, :telefono)');
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':telefono', $telefono);
        return $stmt->execute();
    }
}
