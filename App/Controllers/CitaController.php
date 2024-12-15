<?php
namespace App\Controllers;

use Core\View;
use App\Models\Cita;
use App\Models\Usuario;
use App\Models\Propiedad;
use Core\Session;

class CitaController
{
    // Método que muestra la lista de citas
    public function index()
    {
        $session = Session::getInstance();
        $id_cliente = $session->get('id_usuario');
        $rol = $session->get('rol');

        if ($rol === 'cliente') {
            $citas = Cita::where('id_cliente', $id_cliente);
        } else {
            $citas = Cita::all();
        }
        
        // Definir las vistas y los argumentos a pasar
        $views = ['citas/index'];
        $args  = ['title' => 'Lista de Citas', 'citas' => $citas];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva cita
    public function create()
    {
        $agentes = Usuario::where('rol', 'agente');
        $propiedades = Propiedad::all();
        // Definir la vista y los argumentos a pasar
        $views = ['citas/create'];
        $args  = ['title' => 'Agregar Cita', 'agentes' => $agentes, 'propiedades' => $propiedades];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva cita
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_propiedad' => $_POST['id_propiedad'],
                'id_cliente' => !empty($_POST['id_cliente']) ? $_POST['id_cliente'] : null,
                'fecha_hora' => $_POST['fecha_hora'],
                'estado' => 'pendiente',
                'disponible' => true,
                'id_agente' => !empty($_POST['id_agente']) ? $_POST['id_agente'] : null
            ];

            // Validar solapamientos de citas
            $citasExistentes = Cita::where('id_propiedad', $data['id_propiedad']);
            foreach ($citasExistentes as $cita) {
                if ($cita->fecha_hora == $data['fecha_hora']) {
                    header('Location: /profile?error=Ya existe una cita programada para esta propiedad en el mismo horario');
                    exit;
                }
            }

            Cita::create($data);
            
            $this->redirectToProfile(null, null, 'citas');
        }
    }

    // Método que carga los datos de una cita para edición
    public function edit($id)
    {
        // Buscar el usuario por su ID
        $citaToEdit = Cita::find($id);

        $this->redirectToProfile($citaToEdit, null, 'citas');
    }

    // Método que maneja la actualización de una cita
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Buscar el usuario por su ID
            $citaToEdit = Cita::find($_POST['id']);
            
            $data = [
                'id' => $_POST['id'],
                'id_propiedad' => $_POST['id_propiedad'],
                'id_cliente' => $_POST['id_cliente'],
                'fecha_hora' => $_POST['fecha_hora'],
                'estado' => $_POST['estado']
            ];
            
            Cita::update($data);

            $this->redirectToProfile(null, null, 'citas');
        }
    }

    // Método que maneja la eliminación de una cita
    public function delete()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener el ID de la propiedad desde el formulario
            $id = $_POST['id'];
            // Eliminar la propiedad por su ID
            Cita::delete($id);

            $this->redirectToProfile(null, null, 'citas');
        }
    }

    // Método que maneja la creación de horas disponibles para visitas
    public function addAvailableHours()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_propiedad' => $_POST['id_propiedad'],
                'id_agente' => $_POST['id_agente'],
                'fecha_hora' => $_POST['fecha_hora']
            ];

            // Validar solapamientos de horas disponibles
            $horasExistentes = Cita::where('id_propiedad', $data['id_propiedad']);
            foreach ($horasExistentes as $hora) {
                if ($hora->fecha_hora == $data['fecha_hora']) {
                    header('Location: /profile?error=Ya existe una hora disponible para esta propiedad en el mismo horario');
                    exit;
                }
            }

            Cita::create($data);

            $this->redirectToProfile(null, null, 'citas');
        }
    }

    // Método que maneja la cancelación de una cita por parte del cliente
    public function cancel()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            if ($cita && $cita->id_cliente == Session::getInstance()->get('id_usuario')) {
                $cita->estado = 'cancelado';
                $cita->disponible = true;
                Cita::update([
                    'id' => $cita->id_cita,
                    'id_propiedad' => $cita->id_propiedad,
                    'id_cliente' => $cita->id_cliente,
                    'fecha_hora' => $cita->fecha_hora,
                    'estado' => $cita->estado,
                    'disponible' => $cita->disponible
                ]);
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    private function redirectToProfile($citaToEdit = null, $propiedadToEdit = null, $activeTab = 'citas')
    {
        $session = Session::getInstance();
        $session->set('active_tab', $activeTab);

        $usuarios = Usuario::all();
        $propiedades = Propiedad::all();
        $citas = Cita::all();
        $agentes = Usuario::where('rol', 'agente');

        $views = ['usuarios/profile/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => $session->get('nombre'),
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'citaToEdit' => $citaToEdit,
            'activeTab' => $activeTab,
            'agentes' => $agentes,
            'rol' => $session->get('rol')
        ];

        View::render($views, $args);
    }

    public function agendar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_cita = $_POST['id_cita'];
            $cita = Cita::find($id_cita);
            $cita->id_cliente = Session::getInstance()->get('id_usuario');
            $cita->estado = 'confirmado';
            $cita->disponible = false;
            Cita::update([
                'id' => $cita->id_cita,
                'id_propiedad' => $cita->id_propiedad,
                'id_cliente' => $cita->id_cliente,
                'fecha_hora' => $cita->fecha_hora,
                'estado' => $cita->estado,
                'disponible' => $cita->disponible
            ]);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}

