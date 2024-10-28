<?php
namespace App\Models;

use Core\Model;

class Comentario extends Model {
    public function getAll() {
        $sql = "SELECT * FROM comentarios";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addComentario($data) {
        $sql = "INSERT INTO comentarios (comentario, id_usuario, id_inmueble) VALUES (:comentario, :id_usuario, :id_inmueble)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }

    public function getComentariosByInmueble($id) {
        $sql = "SELECT * FROM comentarios WHERE id_inmueble = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public function deleteComentario($id){
        $sql = "DELETE FROM comentarios WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $_POST['id']]);
    }

    public function getComentario($id){
        $sql = "SELECT * FROM comentarios WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

}
