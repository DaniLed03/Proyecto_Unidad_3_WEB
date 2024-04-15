<?php
// verificar_pelis_asociadas.php

require_once('db.php');

// Verificar si existen películas asociadas al género
if (isset($_POST['id_genero'])) {
    $id_genero = $_POST['id_genero'];

    $conexion = new Conexion();
    $conn = $conexion->conectar();

    $query = "SELECT COUNT(*) AS num_pelis FROM pelicula WHERE id_genero = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $id_genero);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $num_pelis = $row['num_pelis'];

    // Devolver "true" si hay películas asociadas, "false" si no las hay
    if ($num_pelis > 0) {
        echo "true";
    } else {
        echo "false";
    }

    $conn->close();
}
?>
