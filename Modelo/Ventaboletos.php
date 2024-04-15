<?php

require_once 'db.php';

class VentaBoletos {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarVenta($id_pelicula, $cantidad, $id_cliente, $id_empleado, $fecha, $total) {
        $conexion = $this->conexion->conectar();
    
        $query = "INSERT INTO ticket_pelicula (id_pelicula, cantidad, id_cliente, id_empleado, fecha, total) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("iiissi", $id_pelicula, $cantidad, $id_cliente, $id_empleado, $fecha, $total);
                
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Puedes agregar más métodos según tus necesidades, como editar, eliminar, obtener, etc.
}

?>
