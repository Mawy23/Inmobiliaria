<?php
namespace App\Controllers;

use App\Models\Rol;

class RolController {
    protected $rolModel;

    public function __construct() {
        $this->rolModel = new Rol();
    }

    public function index() {
        $roles = $this->rolModel->getAll();
        // Lógica para devolver la vista con los roles
    }

    public function store($data) {
        $this->rolModel->addRol($data);
        // Redireccionar o devolver respuesta
    }
}
