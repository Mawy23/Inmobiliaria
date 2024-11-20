<?php
namespace App\Controllers;

use Core\View;
use Core\Session;

class ProfileController
{
    public function index()
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $rol = $session->get('rol');

        // Redirigir según el rol del usuario
        if ($rol === 'admin') {
            $this->adminPanel();
        } elseif ($rol === 'agente') {
            $this->agentPanel();
        } else {
            $this->userPanel();
        }
    }

    public function adminPanel()
    {
        // Obtener la sesión del administrador
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $usuarios = []; // Obtener todos los usuarios
        $propiedades = []; // Obtener todas las propiedades
        $citas = []; // Obtener todas las citas

        // Cargar vista del panel del administrador
        $views = ['usuarios/profile/admin/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => $nombre,
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas
        ];
        View::render($views, $args);
    }

    public function agentPanel()
    {
        // Obtener la sesión del agente
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $citas = []; // Obtener citas del agente
        $propiedades = []; // Obtener propiedades del agente
        $peticiones = []; // Obtener peticiones de venta
        $clientes = []; // Obtener clientes del agente

        // Cargar vista del panel del agente
        $views = ['usuarios/profile/agent/profile'];
        $args = [
            'title' => 'Panel de Agente',
            'nombre' => $nombre,
            'citas' => $citas,
            'propiedades' => $propiedades,
            'peticiones' => $peticiones,
            'clientes' => $clientes
        ];
        View::render($views, $args);
    }

    public function userPanel()
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $citas = []; // Obtener citas del usuario
        $propiedades = []; // Obtener propiedades del usuario
        $wishlist = []; // Obtener wishlist del usuario

        // Cargar vista del usuario
        $views = ['usuarios/profile/user/profile'];
        $args = [
            'title' => 'Panel de Usuario',
            'nombre' => $nombre,
            'citas' => $citas,
            'propiedades' => $propiedades,
            'wishlist' => $wishlist
        ];
        View::render($views, $args);
    }
}





