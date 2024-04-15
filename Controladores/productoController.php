<?php

require_once('../Modelo/Productos.php');

class ProductoController {
    public function guardarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $costo = $_POST['costo'];
            $inventario = $_POST['inventario'];
            $descripcion = $_POST['descripcion'];

            $producto = new Producto();
            if ($producto->agregarProducto($nombre, $costo, $inventario, $descripcion)) {
                header('Location: ../Vista/listado_productos.php');
                exit;
            } else {
                // Error al guardar el producto
                echo "Error al guardar el producto.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }


    public function editarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $costo = $_POST['costo'];
            $inventario = $_POST['inventario'];
            $descripcion = $_POST['descripcion'];

            $producto = new Producto();
            if ($producto->editarProducto($id_producto, $nombre, $costo, $inventario, $descripcion)) {
                header('Location: ../Vista/listado_productos.php');
                exit;
            } else {
                // Error al editar el producto
                echo "Error al editar el producto.";
            }
        } else {
            // Manejar la solicitud GET de manera apropiada
            echo "Acceso no permitido.";
        }
    }

    /*
    public function eliminarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_producto = $_GET['id'];

            $producto = new Producto();
            if ($producto->eliminarProducto($id_producto)) {
                // Éxito al eliminar el producto
                header('Location: ../Vista/listado_productos.php');
                exit;
            } else {
                // Error al eliminar el producto
                echo "Error al eliminar el producto.";
            }
        } else {
            // Manejar la solicitud POST de manera apropiada
            echo "Acceso no permitido.";
        }
    }*/
    
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $productoController = new ProductoController();
    
    switch ($action) {
        case 'guardar':
            $productoController->guardarProducto();
            break;
        case 'editar':
            $productoController->editarProducto();
            break;
        case 'eliminar':
            $productoController->eliminarProducto();
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "Acción no especificada.";
}

?>
