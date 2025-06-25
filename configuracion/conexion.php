<?php
require_once __DIR__ . '/../configuracion/configuracion.php';

class Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(
            Configuracion::$hostname,
            Configuracion::$username,
            Configuracion::$password,
            Configuracion::$dbname
        );

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function obtenerConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>