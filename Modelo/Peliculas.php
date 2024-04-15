<?php

require_once 'db.php';

class Peliculas {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarPelicula($nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $boletos) {
        $conexion = $this->conexion->conectar();
    
        $query = "INSERT INTO pelicula (nombre, sinopsis, id_genero, fecha_inicio_cartelera, fecha_fin_cartelera, boletos) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ssissi", $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $boletos);
                
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $boletos) {
        $conexion = $this->conexion->conectar();
    
        $query = "UPDATE pelicula SET nombre = ?, sinopsis = ?, id_genero = ?, fecha_inicio_cartelera = ?, fecha_fin_cartelera = ?, boletos = ? WHERE id_pelicula = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ssissii", $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $boletos, $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
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
    }*/
    
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

    public function obtenerPeliculasDisponibles() {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT id_pelicula, nombre FROM pelicula";
        $result = $conexion->query($query);
        
        $peliculas = array();
        while ($row = $result->fetch_assoc()) {
            $peliculas[] = $row;
        }
    
        return $peliculas;
    }

    public function obtenerBoletosPorPelicula($id_pelicula) {
        $conexion = $this->conexion->conectar();
        
        $query = "SELECT boletos FROM pelicula WHERE id_pelicula = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("i", $id_pelicula);
        $statement->execute();
        $statement->bind_result($boletos);
        $statement->fetch();
        $statement->close();
        
        return $boletos;
    }
    
    public function actualizarBoletos($id_pelicula, $nuevos_boletos) {
        $conexion = $this->conexion->conectar();
        
        $query = "UPDATE pelicula SET boletos = ? WHERE id_pelicula = ?";
        $statement = $conexion->prepare($query);
        $statement->bind_param("ii", $nuevos_boletos, $id_pelicula);
    
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    

}

?>
