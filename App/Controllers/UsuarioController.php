<?php
namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController {
    protected $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function index() {
        $usuarios = $this->usuarioModel->getAll();
        // Lógica para devolver la vista con los usuarios
    }

    public function store($data) {
        $this->usuarioModel->addUsuario($data);
        // Redireccionar o devolver respuesta
    }
}
