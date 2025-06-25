<?php
require_once __DIR__ . '/../configuracion/conexion.php';

class UsuarioModelo {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion();
        if (!$this->conexion) {
    die("Error en la conexión a la base de datos");
}

    }

    public function obtenerUsuarioPorNombre($username) {
        $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE usuario = ?");
        
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearUsuario($username, $password, $nombre, $es_admin) {
    $stmt = $this->conexion->prepare("SELECT id FROM usuario WHERE usuario = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return ["error" => "El nombre de usuario ya está en uso"];
    }

    $stmt->close();

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $this->conexion->prepare("INSERT INTO usuario (usuario, password, nombre, es_admin) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        return ["error" => "Error al preparar la consulta: " . $this->conexion->error];
    }

    $stmt->bind_param("sssi", $username, $password_hash, $nombre, $es_admin);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return ["success" => "Usuario creado exitosamente"];
    }

return ["error" => "Error al crear el usuario: " . $this->conexion->error];
}

}


