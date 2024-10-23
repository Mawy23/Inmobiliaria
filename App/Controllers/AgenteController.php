<?php
namespace App\Controllers;

use App\Models\Agente;

class AgenteController {
    protected $agenteModel;

    public function __construct() {
        $this->agenteModel = new Agente();
    }

    public function index() {
        $agentes = $this->agenteModel->getAll();
        // Lógica para devolver la vista con los agentes
    }

    public function store($data) {
        $this->agenteModel->addAgente($data);
        // Redireccionar o devolver respuesta
    }
}
