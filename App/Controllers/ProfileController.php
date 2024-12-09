<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\Usuario;
use App\Models\Propiedad;
use App\Models\Cita;
use App\Models\Favorito;

class ProfileController
{
    public function index()
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $rol = $session->get('rol');

        // Redirigir según el rol del usuario
        $this->panel($rol);
    }

    public function panel($rol)
    {
        // Obtener la sesión del usuario
        $session = Session::getInstance();
        $nombre = $session->get('nombre');
        $usuarios = $rol !== 'cliente' ? Usuario::all() : []; // Obtener todos los usuarios solo si es admin o agente
        $propiedades = Propiedad::all();
        $citas = $rol === 'admin' ? Cita::all() : Cita::where('id_agente', $session->get('id_usuario')); // Obtener todas las citas o las del usuario
        $agentes = $rol !== 'cliente' ? Usuario::where('rol', 'agente') : []; // Obtener todos los agentes solo si es admin o agente
        $favoritos = $rol === 'cliente' ? Favorito::getFavoritosConDetalles($session->get('id_usuario')) : []; // Obtener los favoritos con detalles
        $historialCitas = $rol === 'cliente' ? Cita::where('id_cliente', $session->get('id_usuario')) : [];
        $misPropiedades = $rol === 'cliente' ? Propiedad::where('id_cliente', $session->get('id_usuario')) : [];
        $activeTab = $rol === 'cliente' ? 'favoritos' : 'usuarios'; // Establecer la pestaña activa según el rol

        // Depuración
        error_log('Favoritos: ' . print_r($favoritos, true));

        // Cargar vista del panel
        $views = ['usuarios/profile/profile'];
        $args = [
            'title' => 'Panel de ' . ucfirst($rol),
            'nombre' => $nombre,
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'agentes' => $agentes,
            'favoritos' => $favoritos,
            'historialCitas' => $historialCitas,
            'misPropiedades' => $misPropiedades,
            'active_tab' => $activeTab,
            'rol' => $rol
        ];
        View::render($views, $args);
    }
}





