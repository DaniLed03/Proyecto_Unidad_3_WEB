<?php
// Verifica si se ha recibido el ID del producto
if(isset($_POST['id_producto'])) {
    try {
        // Incluye el archivo de la clase Producto
        require_once('../Modelo/Productos.php');

        // Crea una instancia de la clase Producto
        $producto = new Producto();

        // Obtiene el ID del producto desde la solicitud POST
        $id_producto = $_POST['id_producto'];

        // Llama a la función obtenerPrecioProducto para obtener el precio del producto
        $precio = $producto->obtenerPrecioProducto($id_producto);

        // Devuelve el precio como respuesta
        echo $precio;
    } catch (Exception $e) {
        // Manejo de errores: si ocurre un error, devuelve un mensaje de error
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se recibe el ID del producto, devuelve un mensaje de error
    echo "Error: No se recibió el ID del producto.";
}
?>
