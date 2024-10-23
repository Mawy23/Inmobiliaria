<?php

// Definimos el espacio de nombres 'Core' para organizar la estructura del core de la aplicación
namespace Core;

// Usamos la clase Config desde el espacio de nombres 'App\Config' para acceder a la configuración de la base de datos
use App\Config\Config;

// Usamos la clase PDO para la conexión con la base de datos
use PDO;

// Definimos la clase 'Model', que manejará la lógica de la conexión a la base de datos
class Model
{
    // Propiedad para almacenar la conexión con la base de datos
    public $db = null;

    // Constructor de la clase 'Model' que se ejecuta al instanciar un objeto
    public function __construct()
    {
        try {
            // Intentamos abrir la conexión con la base de datos
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            // Si ocurre un error en la conexión, mostramos un mensaje y detenemos la ejecución
            exit('Database connection could not be established.');
        }
    }

    // Método privado para establecer la conexión con la base de datos
    private function openDatabaseConnection()
    {
        // Si el puerto está vacío, omitimos su paso en el DSN
        if (Config::DB_PORT) {
            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s;charset=%s",
                Config::DB_HOST,
                Config::DB_PORT,
                Config::DB_NAME,
                Config::DB_CHARSET
            );
        } else {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                Config::DB_HOST,
                Config::DB_NAME,
                Config::DB_CHARSET
            );
        }

        // Opciones para la conexión con PDO
        $options  = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];

        // Establecemos la conexión a la base de datos
        $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $options);
    }
}
