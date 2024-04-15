<?php

require_once('../Modelo/Ventasnacks.php');
require_once('../Modelo/Productos.php'); // Agregar el modelo de Productos

class VentaSnacksController {
    public function venta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $precio = $_POST['precio'];
            $fecha = $_POST['fecha'];
            $cantidad = $_POST['cantidad'];
            $id_producto = $_POST['id_producto'];
    
            // Obtener el modelo de venta de snacks y productos
            $ventaSnacks = new VentaSnacks();
            $producto = new Producto();

            // Obtener el inventario actual del producto
            $inventario_actual = $producto->obtenerInventario($id_producto);

            // Verificar si hay suficiente inventario para la venta
            if ($inventario_actual >= $cantidad) {
                // Restar la cantidad vendida al inventario
                $nuevo_inventario = $inventario_actual - $cantidad;

                // Actualizar el inventario en la base de datos
                if ($producto->actualizarInventario($id_producto, $nuevo_inventario)) {
                    // Agregar la venta de snacks
                    if ($ventaSnacks->agregarVenta($precio, $id_cliente, $id_empleado, $fecha, $cantidad, $id_producto)) {
                        // Venta de snacks realizada con éxito, redirigir a la página de inicio o a donde sea necesario
                        header('Location: ../Vista/menu.html');
                        exit;
                    } else {
                        // Error al agregar la venta de snacks
                        echo "Error al agregar la venta de snacks.";
                    }
                } else {
                    // Error al actualizar el inventario del producto
                    echo "Error al actualizar el inventario del producto.";
                }
            } else {
                // No hay suficiente inventario para la venta
                echo "No hay suficiente inventario para realizar esta venta.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }     
}

// Verificar si ya se procesó el formulario antes de manejarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'venta') {
    $ventaSnacksController = new VentaSnacksController();
    $ventaSnacksController->venta();
}

?>
