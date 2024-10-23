<?php
namespace App\Controllers;

use App\Models\Transaccion;

class TransaccionController {
    protected $transaccionModel;

    public function __construct() {
        $this->transaccionModel = new Transaccion();
    }

    public function index() {
        $transacciones = $this->transaccionModel->getAll();
        // Lógica para devolver la vista con las transacciones
    }

    public function store($data) {
        $this->transaccionModel->addTransaccion($data);
        // Redireccionar o devolver respuesta
    }
}
