<?php

require_once('../Modelo/Productos.php');

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del producto y la cantidad enviada desde el formulario
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Crear una instancia del modelo Producto
    $producto = new Producto();

    // Obtener el inventario actual del producto
    $inventario_actual = $producto->obtenerInventario($id_producto);

    // Verificar si hay suficiente inventario para la venta
    if ($inventario_actual >= $cantidad) {
        // Si hay suficiente inventario, responder con 'OK'
        echo 'OK';
    } else {
        // Si no hay suficiente inventario, responder con un mensaje de error
        echo 'ERROR';
    }
} else {
    // Si la solicitud no es de tipo POST, responder con un mensaje de error
    echo 'ERROR';
}

?>
