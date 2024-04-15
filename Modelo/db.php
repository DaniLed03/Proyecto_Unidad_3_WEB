<?php
class Conexion {
    private $host = "localhost";
    private $user = "admin";
    private $password = "d774705097f7c6ba20213392b4a675699756d57b4f94b221";
    private $database = "cinema";

    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
