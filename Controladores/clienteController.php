<?php

require_once('../Modelo/Cliente.php');

class ClienteController {
    public function altaCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            $cliente = new Cliente();
            if ($cliente->agregarCliente($nombre, $edad)) {
                header('Location: ../Vista/listado_clientes.php');
                exit;
            } else {
                echo "Error al agregar el cliente.";
            }
        } else {
            echo "Acceso no permitido.";
        }
    }

    public function editarCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['id_cliente'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            $cliente = new Cliente();
            if ($cliente->editarCliente($id_cliente, $nombre, $edad)) {
                header('Location: ../Vista/listado_clientes.php');
                exit;
            } else {
                echo "Error al editar el cliente.";
            }
        } else {
            echo "Acceso no permitido.";
        }
    }

    /*
    public function eliminarCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_cliente = $_GET['id'];

            $cliente = new Cliente();
            if ($cliente->eliminarCliente($id_cliente)) {
                header('Location: ../Vista/listado_clientes.php');
                exit;
            } else {
                echo "Error al eliminar el cliente.";
            }
        } else {
            echo "Acceso no permitido.";
        }
    }*/
}

// Acceder a la acción según la solicitud
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $clienteController = new ClienteController();

    switch ($action) {
        case 'alta':
            $clienteController->altaCliente();
            break;
        case 'editar':
            $clienteController->editarCliente();
            break;
        case 'eliminar':
            $clienteController->eliminarCliente();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
}

?>
