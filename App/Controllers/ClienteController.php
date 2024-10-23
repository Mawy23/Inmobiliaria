<?php
namespace App\Controllers;

use App\Models\Cliente;

class ClienteController {
    protected $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    public function index() {
        $clientes = $this->clienteModel->getAll();
        // Lógica para devolver la vista con los clientes
    }

    public function store($data) {
        $this->clienteModel->addCliente($data);
        // Redireccionar o devolver respuesta
    }
}
