<?php

require_once('db.php');

class Producto {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarProducto($nombre, $costo, $inventario, $descripcion) {
        $conexion = $this->conexion->conectar();

        $query = "INSERT INTO producto (nombre, costo, inventario, descripcion) VALUES (?, ?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("sids", $nombre, $costo, $inventario, $descripcion);
        if ($statement->execute()) {
            return true; // Producto agregado con éxito
        } else {
            return false; // Error al agregar producto
        }
    }


    public function editarProducto($id_producto, $nombre, $costo, $inventario, $descripcion) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE producto SET nombre = ?, costo = ?, inventario = ?, descripcion = ? WHERE id_producto = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("sidsi", $nombre, $costo, $inventario, $descripcion, $id_producto);
    
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function eliminarProducto($id_producto) {
        $conexion = $this->conexion->conectar();

        $query = "DELETE FROM producto WHERE id_producto = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_producto);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerNombreProducto($id_producto) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT nombre FROM producto WHERE id_producto = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_producto);
        $statement->execute();
        $statement->bind_result($nombre);
        $statement->fetch();
        $statement->close();
        
        return $nombre;
    }
    
}

?>
