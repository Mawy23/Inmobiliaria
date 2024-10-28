<?php
namespace App\Models;

use PDO;


class Inmueble {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=inmobiliaria", "root", "");
    }

    // Obtener todos los inmuebles
    public function getAllInmuebles() {
        $sql = "SELECT * FROM inmuebles";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un inmueble por ID
    public function getInmuebleById($idInmueble) {
        $sql = "SELECT * FROM inmuebles WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $idInmueble]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo inmueble
    public function crearInmueble($direccion, $descripcion, $precio) {
        $sql = "INSERT INTO inmuebles (direccion, descripcion, precio) VALUES (:direccion, :descripcion, :precio)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'direccion' => $direccion,
            'descripcion' => $descripcion,
            'precio' => $precio
        ]);
    }

    // Modificar un inmueble existente
    public function modificarInmueble($idInmueble, $direccion, $descripcion, $precio) {
        $sql = "UPDATE inmuebles SET direccion = :direccion, descripcion = :descripcion, precio = :precio WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'direccion' => $direccion,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'id' => $idInmueble
        ]);
    }

    // Eliminar un inmueble
    public function eliminarInmueble($idInmueble) {
        $sql = "DELETE FROM inmuebles WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $idInmueble]);
    }
}
?>
