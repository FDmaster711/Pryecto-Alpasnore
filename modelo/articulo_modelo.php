<?php
require_once __DIR__ . '/../configuracion/conexion.php';

class ArticuloModelo {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion();
    }

    public function existeCodigo($codigo) {
        $stmt = $this->conexion->prepare("SELECT id FROM articulos WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function registrarArticulo($codigo, $nombre, $descripcion, $precio, $cantidad) {
        $stmt = $this->conexion->prepare("INSERT INTO articulos (codigo, nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return ["error" => "Error al preparar consulta: " . $this->conexion->error];
        }
        $stmt->bind_param("sssdi", $codigo, $nombre, $descripcion, $precio, $cantidad);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return ["mensaje" => "Producto registrado exitosamente!"];
        }

        return ["error" => "Error al registrar el producto: " . $stmt->error];
    }
    
    public function obtenerTodos() {
    $result = $this->conexion->query("SELECT id, codigo, nombre, cantidad FROM articulos ORDER BY nombre");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

public function obtenerPorId($id) {
    $stmt = $this->conexion->prepare("SELECT id, codigo, nombre, cantidad, precio FROM articulos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


public function actualizarCantidad($id, $nuevaCantidad) {
    $stmt = $this->conexion->prepare("UPDATE articulos SET cantidad = ? WHERE id = ?");
    $stmt->bind_param("ii", $nuevaCantidad, $id);
    return $stmt->execute() && $stmt->affected_rows > 0;
}

public function buscarArticulos($busqueda = '', $filtro = 'todos') {
    $query = "SELECT id, codigo, nombre, cantidad, precio FROM articulos WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($busqueda)) {
        $query .= " AND (nombre LIKE ? OR codigo LIKE ?)";
        $params[] = "%$busqueda%";
        $params[] = "%$busqueda%";
        $types .= 'ss';
    }

    if ($filtro === 'bajo') {
        $query .= " AND cantidad < 10";
    } elseif ($filtro === 'agotado') {
        $query .= " AND cantidad = 0";
    } elseif ($filtro === 'disponible') {
        $query .= " AND cantidad > 0";
    }

    $query .= " ORDER BY nombre";
    $stmt = $this->conexion->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


}
