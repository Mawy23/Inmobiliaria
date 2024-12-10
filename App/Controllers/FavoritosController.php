<?php
namespace App\Controllers;

use Core\Session;
use App\Models\Favorito;
use App\Models\Propiedad;

class FavoritosController
{
    public function toggle()
    {
        $session = Session::getInstance();
        $id_cliente = $session->get('id_usuario');
        $id_propiedad = $_POST['id_propiedad'];

        // Verificar si el cliente y la propiedad están definidos
        if (!$id_cliente || !$id_propiedad) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $favorito = Favorito::first($id_cliente, $id_propiedad);

        if ($favorito) {
            $favorito->delete();
        } else {
            $nuevoFavorito = new Favorito();
            $nuevoFavorito->id_cliente = $id_cliente;
            $nuevoFavorito->id_propiedad = $id_propiedad;
            $nuevoFavorito->save();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function getFavoritos()
    {
        $session = Session::getInstance();
        $id_cliente = $session->get('id_usuario');

        if (!$id_cliente) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $favoritos = Favorito::getFavoritosConDetalles($id_cliente);

        return $favoritos;
    }
}