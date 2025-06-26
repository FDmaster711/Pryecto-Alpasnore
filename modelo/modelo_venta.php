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
        $stmt = $this->conexion->prepare("INSERT INTO ventas (cliente, cedula, total, usuario_id) VALUES (?, ?, 0, ?)");
        $stmt->bind_param("ssi", $cliente, $cedula, $usuario_id);
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

}
