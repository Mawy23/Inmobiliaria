<?php
namespace App\Models;

use PDO;

use Core\Model;

class Usuario extends Model {
    public function getAll() {
        $sql = "SELECT * FROM usuarios";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addUsuario($data) {
        $sql = "INSERT INTO usuarios (nombre, email, password, id_rol) VALUES (:nombre, :email, :password, :id_rol)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }

    public function updateUsuario($id, $data) {
        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password, id_rol = :id_rol WHERE id = :id";
        $query = $this->db->prepare($sql);
        $data['id'] = $id;
        return $query->execute($data);
    }

    public function deleteUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }

    public function getUserByCredentials($usuario, $password) {
        $sql = "SELECT id, nombre, apellidos FROM clientes WHERE nombre_usuario = :usuario AND pass = :password";
        $query = $this->db->prepare($sql);
        $query->execute(['usuario' => $usuario, 'password' => $password]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById($id) {
        $sql = "SELECT id, nombre, apellidos FROM clientes WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarioByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $query = $this->db->prepare($sql);
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function registrarUsuario($nombre, $email, $password) {
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $query = $this->db->prepare($sql);
        return $query->execute(['nombre' => $nombre, 'email' => $email, 'password' => $password]);
    }
    
}

