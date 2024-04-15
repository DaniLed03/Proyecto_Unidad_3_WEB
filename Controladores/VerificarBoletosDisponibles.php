<?php
require_once('../Modelo/Peliculas.php');

// Obtener los datos enviados por AJAX
$id_pelicula = $_POST['id_pelicula'];
$cantidad = $_POST['cantidad'];

// Crear una instancia de la clase Peliculas
$pelicula = new Peliculas();

// Verificar la cantidad de boletos disponibles
$boletos_disponibles = $pelicula->obtenerBoletosPorPelicula($id_pelicula);

if ($boletos_disponibles >= $cantidad) {
    // Si hay suficientes boletos disponibles, restar la cantidad de boletos vendidos
    $boletos_actualizados = $boletos_disponibles - $cantidad;
    $pelicula->actualizarBoletos($id_pelicula, $boletos_actualizados);
    echo "success";
} else {
    // Si no hay suficientes boletos disponibles, devolver un mensaje de error
    echo "error";
}
?>
