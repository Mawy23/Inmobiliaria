<?php
namespace App\Controllers;

use App\Models\Inmueble;

class InmuebleController {
    protected $inmuebleModel;

    public function __construct() {
        $this->inmuebleModel = new Inmueble();
    }

    public function index() {
        $inmuebles = $this->inmuebleModel->getAll();
        // Lógica para devolver la vista con los inmuebles
    }

    public function store($data) {
        $this->inmuebleModel->addInmueble($data);
        // Redireccionar o devolver respuesta
    }
}
