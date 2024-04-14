<?php

require_once('../Modelo/Peliculas.php'); // Corregir la ruta del require_once

class PeliculasController {
    public function altaPelicula() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre']; // Cambiar 'titulo' a 'nombre'
            $sinopsis = $_POST['sinopsis'];
            $id_genero = $_POST['id_genero'];
            $fecha_inicio_cartelera = $_POST['fecha_inicio_cartelera'];
            $fecha_fin_cartelera = $_POST['fecha_fin_cartelera'];

            $pelicula = new Peliculas(); // Cambiar 'Pelicula' a 'Peliculas'
            if ($pelicula->agregarPelicula($nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera)) {
                header('Location: ../Vista/listado_peliculas.php');
                exit;
            } else {
                // Error al agregar la película
                echo "Error al agregar la película.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }  

    public function editarPelicula() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $sinopsis = $_POST['sinopsis'];
            $id_genero = $_POST['id_genero'];
            $fecha_inicio_cartelera = $_POST['fecha_inicio_cartelera'];
            $fecha_fin_cartelera = $_POST['fecha_fin_cartelera'];
    
            $pelicula = new Peliculas();
            if ($pelicula->editarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera)) {
                header('Location: ../Vista/listado_peliculas.php');
                exit;
            } else {
                echo "Error al editar la película.";
            }
        } else {
            echo "Acceso no permitido.";
        }
    }
    

    public function eliminarPelicula($id) {
        $pelicula = new Peliculas();
        if ($pelicula->eliminarPelicula($id)) {
            header('Location: ../Vista/listado_peliculas.php');
            exit;
        } else {
            echo "Error al eliminar la película.";
        }
    }

}


// Verificar si ya se procesó el formulario antes de manejarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'alta' && !isset($_SESSION['formulario_enviado'])) {
    $_SESSION['formulario_enviado'] = true;
    $peliculasController = new PeliculasController();
    $peliculasController->altaPelicula();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'editar' && !isset($_SESSION['formulario_enviado'])) {
    $_SESSION['formulario_enviado'] = true;
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sinopsis = $_POST['sinopsis'];
    $id_genero = $_POST['id_genero'];
    $fecha_inicio_cartelera = $_POST['fecha_inicio_cartelera'];
    $fecha_fin_cartelera = $_POST['fecha_fin_cartelera'];

    $peliculasController = new PeliculasController();
    $peliculasController->editarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'eliminar' && !isset($_SESSION['formulario_enviado'])) {
    $_SESSION['formulario_enviado'] = true;
    $id = $_GET['id'];

    $peliculasController = new PeliculasController();
    $peliculasController->eliminarPelicula($id);
}

?>
