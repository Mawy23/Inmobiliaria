<?php
namespace App\Controllers;

use App\Models\Cita;

class CitaController {
    protected $citaModel;

    public function __construct() {
        $this->citaModel = new Cita();
    }

    public function index() {
        $citas = $this->citaModel->getAll();
        // Aquí deberías incluir la lógica para devolver la vista con las citas
    }

    public function store($data) {
        $this->citaModel->addCita($data);
        // Redireccionar o devolver respuesta
    }
}

