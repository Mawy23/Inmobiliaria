<?php
namespace App\Controllers;

use Core\View;
use App\Models\Tasacion;
use Core\Session;

class TasacionController
{
    public function create()
    {
        $session = Session::getInstance();
        $views = ['propiedades/tasar'];
        $args  = [
            'title' => 'Solicitar Tasación',
            'idUsuario' => $session->get('id_usuario'),
            'rol' => $session->get('rol')
        ];
        View::render($views, $args);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $session = Session::getInstance();
            $data = $_POST;
            $data['id_cliente'] = $session->get('id_usuario');
            Tasacion::create($data);
            header('Location: /Inmobiliaria/Home'); // Asegúrate de que esta ruta sea correcta
            exit;
        }
    }

    public function index()
    {
        // Obtener todas las tasaciones de la base de datos
        $tasaciones = Tasacion::all();
        
        // Definir la vista y los argumentos a pasar
        $views = ['usuarios/profile/tasaciones'];
        $args  = ['title' => 'Tasaciones', 'tasaciones' => $tasaciones];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    public function edit($id)
    {
        $tasacionToEdit = Tasacion::find($id);
        $this->redirectToProfile($tasacionToEdit, 'tasaciones');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id'],
                'estado_tasacion' => $_POST['estado_tasacion']
            ];
            Tasacion::update($data);
            $this->redirectToProfile(null, 'tasaciones');
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            Tasacion::delete($id);
            $this->redirectToProfile(null, 'tasaciones');
        }
    }

    private function redirectToProfile($tasacionToEdit = null, $activeTab = 'tasaciones')
    {
        $session = Session::getInstance();
        $session->set('active_tab', $activeTab);

        $tasaciones = Tasacion::all();
        $usuarios = []; // Obtener usuarios si es necesario
        $propiedades = []; // Obtener propiedades si es necesario
        $citas = []; // Obtener citas si es necesario   

        if ($session->get('rol') === 'admin' || $session->get('rol') === 'agente') {
            $usuarios = \App\Models\Usuario::all(); // Asumiendo que hay un modelo Usuario
            $propiedades = \App\Models\Propiedad::all(); // Asumiendo que hay un modelo Propiedad
        }

        $views = ['usuarios/profile/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => $session->get('nombre'),
            'tasaciones' => $tasaciones,
            'tasacionToEdit' => $tasacionToEdit,
            'activeTab' => $activeTab,
            'rol' => $session->get('rol'),
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas

        ];

        View::render($views, $args);
    }
}
