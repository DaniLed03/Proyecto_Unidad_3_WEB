<?php

require_once('db.php'); // Asegúrate de tener una conexión a la base de datos

class VentaSnacks {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion(); // Aquí ajustamos la instancia de la clase de conexión
    }

    public function agregarVenta($precio, $id_cliente, $id_empleado, $fecha, $cantidad, $id_producto){
        $conexion = $this->conexion->conectar();

        // Insertar el ticket_producto
        $query = "INSERT INTO ticket_producto (total, id_cliente, id_empleado) VALUES (?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("dii", $precio, $id_cliente, $id_empleado);
        
        // Ejecutar la consulta
        if ($statement->execute()) {
            // Obtener el ID de la última fila insertada
            $ultimo_id = mysqli_insert_id($conexion);
        
            // Insertar en ticket_producto_producto
            $query2 = "INSERT INTO ticket_producto_producto (id_ticket_snack, id_producto, cantidad, fecha) VALUES (?, ?, ?, ?)";
            $statement2 = $conexion->prepare($query2);
            $statement2->bind_param("iiis", $ultimo_id, $id_producto, $cantidad, $fecha);
        
            // Ejecutar la segunda consulta
            if ($statement2->execute()) {
                return true; // Ambas inserciones realizadas con éxito
            } else {
                return false; // Error al agregar la venta de snacks en ticket_producto_producto
            }
        } else {
            return false; // Error al agregar la venta de snacks en ticket_producto
        }
    }    
}

?>
