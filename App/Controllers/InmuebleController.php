<?php
namespace App\Controllers;

use App\Models\Inmueble;

class InmueblesController {
    protected $inmuebleModel;

    public function __construct() {
        $this->inmuebleModel = new Inmueble();
    }

    // Ver todos los inmuebles
    public function verInmuebles() {
        $inmuebles = $this->inmuebleModel->getAllInmuebles();
        return $inmuebles;
    }

    // Ver un inmueble específico
    public function verInmueble($idInmueble) {
        $inmueble = $this->inmuebleModel->getInmuebleById($idInmueble);
        return $inmueble;
    }

    // Crear un nuevo inmueble
    public function crearInmueble() {
        if (isset($_POST['crear_inmueble'])) {
            $direccion = $_POST['direccion'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->inmuebleModel->crearInmueble($direccion, $descripcion, $precio);
            echo "<div class='alert alert-success'>Inmueble creado con éxito.</div>";
        }
    }

    // Modificar un inmueble existente
    public function modificarInmueble($idInmueble) {
        if (isset($_POST['modificar_inmueble'])) {
            $direccion = $_POST['direccion'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->inmuebleModel->modificarInmueble($idInmueble, $direccion, $descripcion, $precio);
            echo "<div class='alert alert-success'>Inmueble modificado con éxito.</div>";
        }
    }

    // Eliminar un inmueble
    public function eliminarInmueble($idInmueble) {
        if (isset($_POST['eliminar_inmueble'])) {
            $this->inmuebleModel->eliminarInmueble($idInmueble);
            echo "<div class='alert alert-success'>Inmueble eliminado con éxito.</div>";
        }
    }
}
?>
