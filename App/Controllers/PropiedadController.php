<?php
namespace App\Controllers;

use Core\View;
use App\Models\Propiedad;
use App\Models\Usuario;
use App\Models\Cita;
use Core\Session;

class PropiedadController
{
    // Método que maneja la vista de lista de propiedades
    public function index()
    {
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
        $precio_min = isset($_GET['precio_min']) ? $_GET['precio_min'] : null;
        $precio_max = isset($_GET['precio_max']) ? $_GET['precio_max'] : null;
        $ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : null;

        // Obtener propiedades filtradas
        $propiedades = Propiedad::search($tipo, $precio_min, $precio_max, $ciudad);

        // Definir las vistas y los argumentos a pasar
        $views = ['propiedades/buscar','propiedades/listado'];
        $args  = ['title' => 'Busqueda de Inmuebles', 'propiedades' => $propiedades];

        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la vista de detalles de una propiedad específica
    public function show($id)
    {
        // Obtener la propiedad por su ID
        $propiedad = Propiedad::find($id);

        if (!$propiedad) {
            // Manejar el caso en que no se encuentre la propiedad
            throw new \Exception("Propiedad no encontrada.");
        }
        
        // Definir la vista y los argumentos a pasar
        $views = ['propiedades/detalle'];
        $args  = ['title' => 'Detalles de la Propiedad', 'propiedad' => $propiedad];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que muestra el formulario para agregar una nueva propiedad
    public function create()
    {
        // Definir la vista y los argumentos a pasar
        $views = ['propiedades/create'];
        $args  = ['title' => 'Agregar Propiedad'];
        
        // Renderizar la vista con los argumentos
        View::render($views, $args);
    }

    // Método que maneja la creación de una nueva propiedad
    public function store()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Crear una nueva propiedad con los datos del formulario
            $data = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tipo' => $_POST['tipo'],
                'direccion' => $_POST['direccion'],
                'ciudad' => $_POST['ciudad'],
                'estado' => $_POST['estado'],
                'codigo_postal' => $_POST['codigo_postal'],
                'id_agente' => $_POST['id_agente']
            ];
            
            Propiedad::create($data);
            
            $this->redirectToProfile();
        }
    }

    // Método que muestra el formulario para editar una propiedad existente
    public function edit($id)
    {
        // Buscar la propiedad por su ID
        $propiedadToEdit = Propiedad::find($id);

        $this->redirectToProfile(null, $propiedadToEdit, 'propiedades');
    }

    // Método que maneja la actualización de una propiedad existente
    public function update()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Actualizar la propiedad con los nuevos datos
            Propiedad::update($_POST);

            $this->redirectToProfile(null, null, 'propiedades');
        }
    }

    // Método que maneja la eliminación de una propiedad
    public function delete()
    {
        // Verificar que la solicitud sea un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener el ID de la propiedad desde el formulario
            $id = $_POST['id'];
            // Eliminar la propiedad por su ID
            Propiedad::delete($id);

            $this->redirectToProfile(null, null, 'propiedades');
        }
    }

    private function redirectToProfile($usuarioToEdit = null, $propiedadToEdit = null, $activeTab = 'propiedades')
    {
        $usuarios = Usuario::all();
        $propiedades = Propiedad::all();
        $citas = Cita::all();

        $views = ['usuarios/profile/admin/profile'];
        $args = [
            'title' => 'Panel de Administrador',
            'nombre' => Session::getInstance()->get('nombre'),
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'citas' => $citas,
            'usuarioToEdit' => $usuarioToEdit,
            'propiedadToEdit' => $propiedadToEdit,
            'activeTab' => $activeTab
        ];

        View::render($views, $args);
    }
}
