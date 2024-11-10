<?php

namespace App\Models;

use PDO;
use PDOException;
use Exception;

use Core\Model;

class Usuario extends Model
{
    // Método que obtiene todos los usuarios de la base de datos
    public static function all()
    {
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
    public static function find($id)
    {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();

            // Preparamos la consulta SQL para obtener un usuario por su ID
            $stmt = $db->prepare('SELECT * FROM usuarios WHERE id_usuario = :id');

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
    public static function create($data)
    {
        try {
            $db = static::getDB();

            // Preparar consulta sin marcadores de posición
            $stmt = $db->prepare('INSERT INTO usuarios (nombre, apellido, correo_electronico, contraseña, rol, telefono) VALUES (?, ?, ?, ?, ?, ?)');

            // Usar un array para ejecutar los valores
            $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['correo_electronico'],
                $data['contraseña'],
                'cliente',
                $data['telefono']
            ]);
        } catch (PDOException $e) {
            // Imprimir mensaje de error detallado
            echo 'Error al crear el usuario: ' . $e->getMessage();
            exit;
        }
    }

    // Método que crea un nuevo agente en la base de datos
    public static function createAgente($data)
    {
        try {
            $db = static::getDB();

            // Preparar consulta sin marcadores de posición
            $stmt = $db->prepare('INSERT INTO usuarios (nombre, apellido, correo_electronico, contraseña, rol, telefono) VALUES (?, ?, ?, ?, ?, ?)');

            // Usar un array para ejecutar los valores
            $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['correo_electronico'],
                $data['contraseña'],
                'agente',
                $data['telefono']
            ]);
        } catch (PDOException $e) {
            // Imprimir mensaje de error detallado
            echo 'Error al crear el usuario: ' . $e->getMessage();
            exit;
        }
    }

    // Método que actualiza un usuario en la base de datos
    public static function update($data)
    {
        try {
            // Conectarse a la base de datos usando PDO
            $db = static::getDB();

            // Preparar la consulta SQL con signos de interrogación en lugar de nombres de parámetros
            $stmt = $db->prepare('
            UPDATE usuarios 
            SET nombre = ?, 
                apellido = ?, 
                correo_electronico = ?, 
                contraseña = ?, 
                rol = ?, 
                telefono = ? 
            WHERE id_usuario = ?
        ');

            // Ejecutar la consulta pasando un array con los valores en el orden correcto
            $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['correo_electronico'],
                $data['contraseña'],
                $data['rol'],
                $data['telefono'],
                $data['id_usuario']  // Al final, el valor de `id_usuario` para la condición WHERE
            ]);
        } catch (PDOException $e) {
            // Imprimir mensaje de error detallado
            echo 'Error al actualizar el usuario: ' . $e->getMessage();
            exit;
        }
    }




    // Método que elimina un usuario de la base de datos
    public static function delete($id)
    {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();

            // Preparamos la consulta SQL para eliminar un usuario
            $stmt = $db->prepare('DELETE FROM usuarios WHERE id_usuario = :id');

            // Sustituimos el marcador de posición :id por el valor de $id
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecutamos la consulta
            $stmt->execute();
        } catch (PDOException $e) {
            // Si hay un error, lanzamos una excepción
            throw new Exception($e->getMessage());
        }
    }

    // Método que obtiene un usuario por su correo_electronico
    public static function findByEmail($correo_electronico)
    {
        try {
            // Nos conectamos a la base de datos utilizando PDO
            $db = static::getDB();

            // Preparamos la consulta SQL para obtener un usuario por su correo_electronico
            $stmt = $db->prepare('SELECT * FROM usuarios WHERE correo_electronico = :correo_electronico');

            // Sustituimos el marcador de posición :correo_electronico por el valor de $correo_electronico
            $stmt->bindParam(':correo_electronico', $correo_electronico, PDO::PARAM_STR);

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
