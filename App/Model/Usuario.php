<?php
namespace App\Model;

use Core\Model; // Asumiendo que tienes una clase base Model en Core\Model que interactúa con la base de datos

class Usuario extends Model {
    protected $table = 'usuarios'; // Nombre de la tabla de usuarios

    public static function autenticar($email, $password) {
        $db = static::getDB(); // Método de la clase base para obtener la conexión a la base de datos
        $stmt = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

    public static function getById($id) {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}

