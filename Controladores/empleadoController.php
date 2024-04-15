<?php

require_once('../Modelo/Empleado.php');

class EmpleadoController {
    public function guardarEmpleado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            $empleado = new Empleado();
            if ($empleado->agregarEmpleado($nombre, $edad)) {
                header('Location: ../Vista/listado_empleados.php');
                exit;
            } else {
                // Error al guardar el empleado
                echo "Error al guardar el empleado.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }


    public function editarEmpleado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_empleado = $_POST['id_empleado'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            $empleado = new Empleado();
            if ($empleado->editarEmpleado($id_empleado, $nombre, $edad)) {
                header('Location: ../Vista/listado_empleados.php');
                exit;
            } else {
                // Error al editar el empleado
                echo "Error al editar el empleado.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }

    /*
    public function eliminarEmpleado() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_empleado = $_GET['id'];

            $empleado = new Empleado();
            if ($empleado->eliminarEmpleado($id_empleado)) {
                // Éxito al eliminar el empleado
                header('Location: ../Vista/listado_empleados.php');
                exit;
            } else {
                // Error al eliminar el empleado
                echo "Error al eliminar el empleado.";
            }
        } else {
            // Manejar la solicitud POST de manera apropiada
            echo "Acceso no permitido.";
        }
    }
 */   
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $empleadoController = new EmpleadoController();
    
    switch ($action) {
        case 'guardar':
            $empleadoController->guardarEmpleado();
            break;
        case 'editar':
            $empleadoController->editarEmpleado();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "Acción no especificada.";
}

?>
