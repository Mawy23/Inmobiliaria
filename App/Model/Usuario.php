<?php
namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Usuario extends Model {
    // Método que obtiene todos los usuarios de la base de datos
    public static function all() {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para obtener todos los usuarios
            $stmt = $db->query('SELECT * FROM usuarios');
            
            // Obtenemos los resultados como un array de objetos de la clase Usuario
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\Models\Usuario');
            
            // Devolvemos los resultados
            return $results;
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }
    
    // Método que obtiene un usuario por su ID
    public static function find($id) {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para obtener un usuario por su ID
            $stmt = $db->prepare('SELECT * FROM usuarios WHERE id = :id');
            
            // Sustituimos el marcador de posición :id por el valor de $id
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Ejecutamos la consulta
            $stmt->execute();
            
            // Obtenemos el resultado como un objeto de la clase Usuario
            $result = $stmt->fetchObject('App\Models\Usuario');
            
            // Devolvemos el resultado
            return $result;
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }
    
    // Método que crea un nuevo usuario en la base de datos
    public static function create($data) {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para insertar un nuevo usuario
            $stmt = $db->prepare('INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)');
            
            // Sustituimos los marcadores de posición :nombre, :email y :password por los valores correspondientes
            $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);


        
            // Ejecutamos la consulta
            $stmt->execute();
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }

    // Método que actualiza un usuario en la base de datos
    public static function update($data) {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para actualizar un usuario
            $stmt = $db->prepare('UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id');
            
            // Sustituimos los marcadores de posición :nombre, :email, :password y :id por los valores correspondientes
            $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            
            // Ejecutamos la consulta
            $stmt->execute();
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }

    // Método que elimina un usuario de la base de datos
    public static function delete($id) {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para eliminar un usuario
            $stmt = $db->prepare('DELETE FROM usuarios WHERE id = :id');
            
            // Sustituimos el marcador de posición :id por el valor de $id
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Ejecutamos la consulta
            $stmt->execute();
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }

    // Método que obtiene un usuario por su email
    public static function findByEmail($email) {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();
            
            // Preparamos la consulta SQL para obtener un usuario por su email
            $stmt = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
            
            // Sustituimos el marcador de posición :email por el valor de $email
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            
            // Ejecutamos la consulta
            $stmt->execute();
            
            // Obtenemos el resultado como un objeto de la clase Usuario
            $result = $stmt->fetchObject('App\Models\Usuario');
            
            // Devolvemos el resultado
            return $result;
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }
}