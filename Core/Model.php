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
        // Usamos 'sprintf' para formar el DSN (Data Source Name) de la conexión, utilizando la configuración de la base de datos
        $dsn = sprintf(
            "mysql:host=%s:%s;dbname=%s;charset=%s", 
            Config::DB_HOST,   // Host de la base de datos
            Config::DB_PORT,   // Puerto de la base de datos
            Config::DB_NAME,   // Nombre de la base de datos
            Config::DB_CHARSET // Conjunto de caracteres
        );

        // Opciones para la conexión con PDO:
        // - El modo de obtención por defecto será 'FETCH_OBJ' para devolver resultados como objetos
        // - Activamos el modo de error 'ERRMODE_WARNING' para mostrar advertencias en lugar de excepciones
        $options  = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];

        // Establecemos la conexión a la base de datos utilizando el DSN, el usuario, la contraseña y las opciones
        $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $options);
    }
}
