<?php

require_once('../Modelo/Cliente.php');

class ClienteController {
    public function altaCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            $cliente = new Cliente();
            if ($cliente->agregarCliente($nombre, $edad)) {
                // Éxito al agregar el cliente
                header('Location: ../Vista/listado_clientes.php');
                exit;
            } else {
                // Error al agregar el cliente
                echo "Error al agregar el cliente.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
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
                // Error al editar el cliente
                echo "Error al editar el cliente.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }

    public function eliminarCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_cliente = $_GET['id'];

            $cliente = new Cliente();
            if ($cliente->eliminarCliente($id_cliente)) {
                // Éxito al eliminar el cliente
                header('Location: ../Vista/listado_clientes.php');
                exit;
            } else {
                // Error al eliminar el cliente
                echo "Error al eliminar el cliente.";
            }
        } else {
            // Manejar la solicitud POST de manera apropiada
            echo "Acceso no permitido.";
        }
    }
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
