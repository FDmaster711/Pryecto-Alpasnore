<?php
require_once __DIR__ . '/../configuracion/conexion.php';

class VentaModelo {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->obtenerConexion();
    }

    public function registrarVenta($cliente, $cedula, $carrito, $usuario_id) {
    $this->conexion->begin_transaction();

    try {
        $fecha = date('Y-m-d H:i:s');
 $stmt = $this->conexion->prepare("
    INSERT INTO ventas (cliente, cedula, fecha, usuario_id, total)
    VALUES (?, ?, ?, ?, 0)
");
$stmt->bind_param("sssi", $cliente, $cedula, $fecha, $usuario_id);

        $stmt->execute();
        $venta_id = $stmt->insert_id;

        $total = 0;

        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;

            $stmt_detalle = $this->conexion->prepare(
                "INSERT INTO detalle_venta (venta_id, articulo_id, cantidad, precio_unitario)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt_detalle->bind_param("iiid", $venta_id, $item['id'], $item['cantidad'], $item['precio']);
            $stmt_detalle->execute();

            $stmt_stock = $this->conexion->prepare(
                "UPDATE articulos SET cantidad = cantidad - ? WHERE id = ?"
            );
            $stmt_stock->bind_param("ii", $item['cantidad'], $item['id']);
            $stmt_stock->execute();
        }

        $stmt_total = $this->conexion->prepare("UPDATE ventas SET total = ? WHERE id = ?");
        $stmt_total->bind_param("di", $total, $venta_id);
        $stmt_total->execute();

        $this->conexion->commit();
        return $venta_id;

    } catch (Exception $e) {
        $this->conexion->rollback();
        return false;
    }
}

    public function obtenerFactura($venta_id) {
        $stmt = $this->conexion->prepare(
            "SELECT v.id, v.fecha, v.cedula, v.cliente, v.total, d.cantidad, d.precio_unitario, 
                    a.nombre, a.codigo
             FROM ventas v
             INNER JOIN detalle_venta d ON v.id = d.venta_id
             INNER JOIN articulos a ON d.articulo_id = a.id
             WHERE v.id = ?"
        );
        $stmt->bind_param("i", $venta_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerTodasLasFacturas() {
    $stmt = $this->conexion->prepare(
        "SELECT id, fecha, cliente, cedula, total FROM ventas ORDER BY fecha DESC"
    );
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function obtenerResumenProductos($fechaInicio, $fechaFin) {
    $stmt = $this->conexion->prepare("
        SELECT a.nombre, SUM(d.cantidad) AS total_vendida
        FROM detalle_venta d
        JOIN articulos a ON d.articulo_id = a.id
        JOIN ventas v ON d.venta_id = v.id
        WHERE v.fecha BETWEEN ? AND ?
        GROUP BY a.id
        ORDER BY total_vendida DESC
    ");
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function obtenerDetalleProductosConMonto($inicio, $fin) {
    $stmt = $this->conexion->prepare("
        SELECT 
            a.nombre,
            SUM(d.cantidad) AS cantidad_total,
            SUM(d.cantidad * d.precio_unitario) AS monto_total
        FROM detalle_venta d
        JOIN articulos a ON d.articulo_id = a.id
        JOIN ventas v ON d.venta_id = v.id
        WHERE v.fecha BETWEEN ? AND ?
        GROUP BY a.id
        ORDER BY cantidad_total DESC
    ");
    $stmt->bind_param("ss", $inicio, $fin);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function obtenerMejorVendedor($inicio, $fin) {
    $stmt = $this->conexion->prepare("
        SELECT u.nombre, SUM(v.total) AS monto_total
        FROM ventas v
        JOIN usuario u ON v.usuario_id = u.id
        WHERE v.fecha BETWEEN ? AND ?
        GROUP BY u.id
        ORDER BY monto_total DESC
        LIMIT 1
    ");

    
    if (!$stmt) {
       
        return ['nombre' => 'N/A', 'monto_total' => 0];
    }

    $stmt->bind_param("ss", $inicio, $fin);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}



}
