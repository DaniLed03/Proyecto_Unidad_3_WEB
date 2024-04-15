<?php
class Conexion {
    private $host = "localhost";
    private $user = "admin";
    private $password = "0ac767f4687e54ba37ec17a341b246842ad13b27b19e05d7";
    private $database = "cinema";

    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
