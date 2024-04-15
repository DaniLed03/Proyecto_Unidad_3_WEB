<?php

require_once('../Modelo/VentaBoletos.php');

class VentaBoletosController {
    public function venta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pelicula = $_POST['id_pelicula'];
            $cantidad = $_POST['cantidad'];
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $total = $_POST['total'];

            $ventaBoletos = new VentaBoletos();
            if ($ventaBoletos->agregarVenta($id_pelicula, $cantidad, $id_cliente, $id_empleado, $fecha, $total)) {
                header('Location: ../Vista/reporte_peliculas.php');
                exit;
            } else {
                // Error al agregar la venta de boletos
                echo "Error al agregar la venta de boletos.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }  
}

// Verificar si ya se procesó el formulario antes de manejarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'venta' && !isset($_SESSION['formulario_enviado'])) {
    $_SESSION['formulario_enviado'] = true;
    $ventaBoletosController = new VentaBoletosController();
    $ventaBoletosController->venta();
}

?>
