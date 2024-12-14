<?php
namespace App\Controllers;

use Core\View;
use App\Models\Tasacion;
use Core\Session;

class TasacionController
{
    public function create()
    {
        $views = ['propiedades/tasar'];
        $args  = ['title' => 'Solicitar Tasación'];
        View::render($views, $args);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Tasacion::create($_POST);
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
        $args  = ['title' => 'Mis Tasaciones', 'tasaciones' => $tasaciones];
        
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
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo']
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

        $views = ['usuarios/profile/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => $session->get('nombre'),
            'tasaciones' => $tasaciones,
            'tasacionToEdit' => $tasacionToEdit,
            'activeTab' => $activeTab,
            'rol' => $session->get('rol')
        ];

        View::render($views, $args);
    }
}
