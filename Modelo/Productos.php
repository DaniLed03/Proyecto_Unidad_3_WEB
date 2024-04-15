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
    
    /*
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
    }*/
    
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

    public function obtenerProductosDisponibles() {
        $conexion = $this->conexion->conectar();
    
        $query = "SELECT id_producto, nombre FROM producto";
        $result = $conexion->query($query);
    
        $productos = array();
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        return $productos;
    }
    
    public function obtenerPrecioProducto($id_producto) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT costo FROM producto WHERE id_producto = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_producto);
        $statement->execute();
        $statement->bind_result($precio);
        $statement->fetch();
        $statement->close();
        
        return $precio;
    }

    // Método para obtener el inventario actual de un producto
    public function obtenerInventario($id_producto) {
        $conexion = $this->conexion->conectar();
        $query = "SELECT inventario FROM producto WHERE id_producto = ?";
        
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_producto);
        $statement->execute();
        $statement->bind_result($inventario);
        $statement->fetch();
        $statement->close();

        return $inventario;
    }

    // Método para actualizar el inventario de un producto
    public function actualizarInventario($id_producto, $nuevo_inventario) {
        $conexion = $this->conexion->conectar();
        $query = "UPDATE producto SET inventario = ? WHERE id_producto = ?";
        
        $statement = $conexion->prepare($query);
        $statement->bind_param("ii", $nuevo_inventario, $id_producto);
        $result = $statement->execute();
        $statement->close();

        return $result;
    }
    
}

?>
