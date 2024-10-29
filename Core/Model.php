<?php

namespace Core;

use App\Config\Config;
use PDO;

class Model
{
    public static $db = null;

    public function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    private function openDatabaseConnection()
    {
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

        $options  = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];

        self::$db = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $options);
    }

    // Método estático que devuelve la conexión de la base de datos
    public static function getDB()
    {
        if (self::$db === null) {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                Config::DB_HOST,
                Config::DB_NAME,
                Config::DB_CHARSET
            );
            $options  = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ];

            // Crea la conexión solo si aún no existe
            self::$db = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $options);
        }

        return self::$db;
    }
}
