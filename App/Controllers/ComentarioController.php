<?php
namespace App\Controllers;

use App\Models\Comentario;

class ComentarioController {
    protected $comentarioModel;

    public function __construct() {
        $this->comentarioModel = new Comentario();
    }

    public function index() {
        $comentarios = $this->comentarioModel->getAll();
        // Lógica para devolver la vista con los comentarios
    }

    public function store($data) {
        $this->comentarioModel->addComentario($data);
        // Redireccionar o devolver respuesta
    }
}
