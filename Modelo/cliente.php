<?php

require_once('db.php');

class Cliente {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarCliente($nombre, $edad) {
        $conexion = $this->conexion->conectar();

        $query = "INSERT INTO cliente (nombre, edad) VALUES (?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("si", $nombre, $edad);        
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarCliente($id_cliente, $nombre, $edad) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE cliente SET nombre = ?, edad = ? WHERE id_cliente = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("sii", $nombre, $edad, $id_cliente);
    
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function eliminarCliente($id_cliente) {
        $conexion = $this->conexion->conectar();

        $query = "DELETE FROM cliente WHERE id_cliente = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_cliente);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerNombreCliete($id_cliente) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT nombre FROM cliente WHERE id_cliente = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_cliente);
        $statement->execute();
        $statement->bind_result($nombre);
        $statement->fetch();
        $statement->close();
        
        return $nombre;
    }
    
}

?>
