<?php
class Conexion {
    private $host = "localhost";
    private $user = "root";
    private $password = "D4n13l2003";
    private $database = "cinema";

    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
