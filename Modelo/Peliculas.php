<?php

require_once 'db.php';

class Peliculas {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarPelicula($nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera) {
        $conexion = $this->conexion->conectar();
    
        $query = "INSERT INTO pelicula (nombre, sinopsis, id_genero, fecha_inicio_cartelera, fecha_fin_cartelera) VALUES (?, ?, ?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ssiss", $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera);
        
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE pelicula SET nombre = ?, sinopsis = ?, id_genero = ?, fecha_inicio_cartelera = ?, fecha_fin_cartelera = ? WHERE id_pelicula = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ssissi", $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $id);
        
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function eliminarPelicula($id) {
        $conexion = $this->conexion->conectar();

        $query = "DELETE FROM pelicula WHERE id_pelicula = ?";   
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function obtenerNombrePelicula($id_pelicula) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT nombre FROM pelicula WHERE id_pelicula = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_pelicula);
        $statement->execute();
        $statement->bind_result($nombre);
        $statement->fetch();
        $statement->close();
        
        return $nombre;
    }

}

?>
