<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\Usuario;
use App\Models\Propiedad;
use App\Models\Cita;

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
        $usuarios = Usuario::all(); // Obtener todos los usuarios
        $propiedades = Propiedad::all(); // Obtener todas las propiedades
        $citas = Cita::all(); // Obtener todas las citas
        $activeTab = $_POST['active_tab'] ?? 'usuarios';

        // Cargar vista del panel del administrador
        $views = ['usuarios/profile/admin/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => $nombre,
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'active_tab' => $activeTab
        ];
        View::render($views, $args);
    }

    public function agentPanel()
    {
        // Obtener la sesión del agente
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $citas = Cita::where('id_agente', $session->get('id')); // Obtener citas del agente
        $propiedades = Propiedad::where('id_agente', $session->get('id')); // Obtener propiedades del agente
        $peticiones = []; // Obtener peticiones de venta (deberías implementar la lógica para obtener las peticiones)
        $clientes = Usuario::where('id_agente', $session->get('id')); // Obtener clientes del agente
        $activeTab = $_POST['active_tab'] ?? 'usuarios';

        // Cargar vista del panel del agente
        $views = ['usuarios/profile/agent/profile'];
        $args = [
            'title' => 'Panel de Agente',
            'nombre' => $nombre,
            'citas' => $citas,
            'propiedades' => $propiedades,
            'peticiones' => $peticiones,
            'clientes' => $clientes,
            'active_tab' => $activeTab
        ];
        View::render($views, $args);
    }

    public function userPanel()
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $citas = Cita::where('id_usuario', $session->get('id')); // Obtener citas del usuario
        $propiedades = Propiedad::where('id_usuario', $session->get('id')); // Obtener propiedades del usuario
        $wishlist = []; // Obtener wishlist del usuario (deberías implementar la lógica para obtener la wishlist)
        $activeTab = $_POST['active_tab'] ?? 'usuarios';

        // Cargar vista del usuario
        $views = ['usuarios/profile/user/profile'];
        $args = [
            'title' => 'Panel de Usuario',
            'nombre' => $nombre,
            'citas' => $citas,
            'propiedades' => $propiedades,
            'wishlist' => $wishlist,
            'active_tab' => $activeTab
        ];
        View::render($views, $args);
    }
}





