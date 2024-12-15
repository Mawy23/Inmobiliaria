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
        $usuarios = Usuario::all(); // Obtener todos los usuarios
        $propiedades = Propiedad::all();
        $citas = $rol === 'cliente' ? Cita::where('id_cliente', $session->get('id_usuario')) : Cita::all(); // Obtener citas según el rol
        $agentes = $rol !== 'cliente' ? Usuario::where('rol', 'agente') : []; // Obtener todos los agentes solo si es admin o agente
        $favoritos = $rol === 'cliente' ? Favorito::getFavoritosConDetalles($session->get('id_usuario')) : []; // Obtener los favoritos con detalles
        $historialCitas = $rol === 'cliente' ? Cita::where('id_cliente', $session->get('id_usuario')) : [];
        $misPropiedades = $rol === 'cliente' ? Propiedad::where('id_cliente', $session->get('id_usuario')) : []; // Corrección de la obtención de propiedades para clientes.
        $activeTab = $session->get('active_tab') ?? ($rol === 'cliente' ? 'favoritos' : 'usuarios'); // Establecer la pestaña activa según el rol

        $totalUsuarios = count($usuarios);
        $totalAdmins = count(array_filter($usuarios, fn($u) => $u->rol === 'admin'));
        $totalAgentes = count(array_filter($usuarios, fn($u) => $u->rol === 'agente'));
        $totalClientes = count(array_filter($usuarios, fn($u) => $u->rol === 'cliente'));

        $totalPropiedades = count($propiedades);
        $propiedadesDisponibles = count(array_filter($propiedades, fn($p) => $p->estado === 'disponible'));
        $propiedadesVendidas = count(array_filter($propiedades, fn($p) => $p->estado === 'vendido'));
        $propiedadesAlquiladas = count(array_filter($propiedades, fn($p) => $p->estado === 'alquilado'));

        $totalCitas = count($citas);
        $citasPendientes = count(array_filter($citas, fn($c) => $c->estado === 'pendiente'));
        $citasConfirmadas = count(array_filter($citas, fn($c) => $c->estado === 'confirmado'));
        $citasCanceladas = count(array_filter($citas, fn($c) => $c->estado === 'cancelado'));

        // Obtener estadísticas históricas de búsqueda
        $searchStats = Propiedad::getSearchHistoryStats();
        $searchStatsLabels = array_keys($searchStats['tipo']);
        $searchStatsData = [
            'tipo' => array_values($searchStats['tipo'])
        ];

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
            'rol' => $rol,
            'totalUsuarios' => $totalUsuarios,
            'totalAdmins' => $totalAdmins,
            'totalAgentes' => $totalAgentes,
            'totalClientes' => $totalClientes,
            'totalPropiedades' => $totalPropiedades,
            'propiedadesDisponibles' => $propiedadesDisponibles,
            'propiedadesVendidas' => $propiedadesVendidas,
            'propiedadesAlquiladas' => $propiedadesAlquiladas,
            'totalCitas' => $totalCitas,
            'citasPendientes' => $citasPendientes,
            'citasConfirmadas' => $citasConfirmadas,
            'citasCanceladas' => $citasCanceladas,
            'searchStatsLabels' => $searchStatsLabels,
            'searchStatsData' => $searchStatsData
        ];
        View::render($views, $args);
    }
}





