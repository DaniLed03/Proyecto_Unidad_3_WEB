<?php

require_once('db.php');

class Empleado {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarEmpleado($nombre, $edad) {
        $conexion = $this->conexion->conectar();

        $query = "INSERT INTO empleado (nombre, edad) VALUES (?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("si", $nombre, $edad);
        if ($statement->execute()) {
            return true; // Empleado agregado con éxito
        } else {
            return false; // Error al agregar empleado
        }
    }


    public function editarEmpleado($id_empleado, $nombre, $edad) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE empleado SET nombre = ?, edad = ? WHERE id_empleado = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("sii", $nombre, $edad, $id_empleado);
    
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function eliminarEmpleado($id_empleado) {
        $conexion = $this->conexion->conectar();

        $query = "DELETE FROM empleado WHERE id_empleado = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_empleado);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerNombreEmpleado($id_empleado) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT nombre FROM empleado WHERE id_empleado = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_empleado);
        $statement->execute();
        $statement->bind_result($nombre);
        $statement->fetch();
        $statement->close();
        
        return $nombre;
    }
    
}

?>
