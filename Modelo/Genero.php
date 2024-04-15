<?php

require_once('db.php');

class Genero {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarGenero($nombre) {
        $conexion = $this->conexion->conectar();

        $query = "INSERT INTO genero (nombre) VALUES (?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("s", $nombre);
        
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarGenero($id, $nombre) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE genero SET nombre = ? WHERE id_genero = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("si", $nombre, $id);
        
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
    public function eliminarGenero($id) {
        $conexion = $this->conexion->conectar();
    
        // Verificar si existen películas asociadas al género
        $query_check = "SELECT COUNT(*) AS num_pelis FROM pelicula WHERE id_genero = ?";
        $statement_check = $conexion->prepare($query_check);
        $statement_check->bind_param("i", $id);
        $statement_check->execute();
        $result_check = $statement_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $num_pelis = $row_check['num_pelis'];
    
        // Si hay películas asociadas, no se puede eliminar el género
        if ($num_pelis > 0) {
            return false;
        }
    
        // Si no hay películas asociadas, proceder con la eliminación del género
        $query_delete = "DELETE FROM genero WHERE id_genero = ?";
        $statement_delete = $conexion->prepare($query_delete);
        $statement_delete->bind_param("i", $id);
    
        if ($statement_delete->execute()) {
            return true;
        } else {
            return false;
        }
    }*/
    

    public function listarGeneros() {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT id_genero, nombre FROM genero";
        $result = $conexion->query($query);
        
        $generos = array();
        
        while ($row = $result->fetch_assoc()) {
            $generos[] = $row;
        }
        
        return $generos;
    }

    public function obtenerNombreGenero($id_genero) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT nombre FROM genero WHERE id_genero = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_genero);
        $statement->execute();
        $statement->bind_result($nombre);
        $statement->fetch();
        $statement->close();
        
        return $nombre;
    }
    
    
    
}

?>
