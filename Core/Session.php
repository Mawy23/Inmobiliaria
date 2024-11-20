<?php
namespace Core;

class Session
{
    // Propiedad para almacenar la instancia de la clase
    private static $instance = null;

    // Constructor privado para evitar que se pueda instanciar la clase
    private function __construct()
    {
        // Iniciamos la sesión
        session_start();
    }

    // Método para obtener la instancia de la clase
    public static function getInstance()
    {
        // Si no existe la instancia, la creamos
        if (self::$instance === null) {
            self::$instance = new self;
        }

        // Devolvemos la instancia
        return self::$instance;
    }

    // Método para establecer un valor en la sesión
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Método para obtener un valor de la sesión
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Método para eliminar un valor de la sesión
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    // Método para destruir la sesión
    public function destroy()
    {
        session_destroy();
    }

    // Método para verificar si un usuario está autenticado
    public static function checkAuth()
    {
        return isset($_SESSION['id_usuario']);
    }

    // Método para verificar si un usuario es administrador
    public static function isAdmin()
    {
        return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
    }

    // Método para verificar si un usuario es agente
    public static function isAgent()
    {
        return isset($_SESSION['rol']) && $_SESSION['rol'] === 'agente';
    }

    // Método para verificar si un usuario es usuario
    public static function isUser()
    {
        return isset($_SESSION['rol']) && $_SESSION['rol'] === 'usuario';
    }
}