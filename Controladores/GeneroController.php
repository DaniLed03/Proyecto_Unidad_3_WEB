<?php

require_once('../Modelo/Genero.php');

class GeneroController {
    public function altaGenero() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $genero = new Genero();
            if ($genero->agregarGenero($nombre)) {
                // Éxito al agregar el género
                header('Location: ../Vista/listado_generos.php');
                exit;
            } else {
                // Error al agregar el género
                echo "Error al agregar el género.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }

    public function editarGenero($id, $nombre) {
        $genero = new Genero();
        if ($genero->editarGenero($id, $nombre)) {
            header('Location: ../Vista/listado_generos.php');
            exit;
        } else {
            echo "Error al editar el género.";
        }
    }
    
    public function eliminarGenero($id) {
        $genero = new Genero();
        if ($genero->eliminarGenero($id)) {
            header('Location: ../Vista/listado_generos.php');
            exit;
        } else {
            echo "Error al eliminar el género.";
        }
    }
    
}

// Acceder a la acción según la solicitud
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $generoController = new GeneroController();

    switch ($action) {
        case 'alta':
            $generoController->altaGenero();
            break;
        case 'editar':
            $id = $_POST['id'];
            $nombre = $_POST['nombre']; // Asegúrate de obtener el nombre del género
            $generoController->editarGenero($id, $nombre); // Asegúrate de pasar tanto $id como $nombre
            break;   
        case 'eliminar':
            $id = $_GET['id'];
            $generoController->eliminarGenero($id);
            break;
        default:
            echo "Acción no válida.";
            break;
    }
}

// Acceder a la acción según la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'eliminar') {
        $id = $_POST['id'];
        $generoController = new GeneroController();
        $generoController->eliminarGenero($id);
    } else {
        // Manejar otras acciones POST si es necesario
    }
}

?>
