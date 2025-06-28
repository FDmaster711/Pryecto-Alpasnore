<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/modelo/modelo_venta.php';

$ventaModelo = new VentaModelo();
$fechaFin = date('Y-m-d 23:59:59');
$fechaInicio = date('Y-m-d 00:00:00', strtotime('-15 days'));

$datos = $ventaModelo->obtenerDetalleProductosConMonto($fechaInicio, $fechaFin);
$mejorVendedor = $ventaModelo->obtenerMejorVendedor($fechaInicio, $fechaFin);
$totalGeneral = array_sum(array_column($datos, 'monto_total'));

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=reporte_quincenal_' . date('Ymd') . '.csv');

// Función personalizada para usar punto y coma como delimitador
function fputcsv_custom($handle, $fields, $delimiter = ';', $enclosure = '"', $escape_char = "\\") {
    return fputcsv($handle, $fields, $delimiter, $enclosure, $escape_char);
}

// Abrir el output con BOM para UTF-8
echo "\xEF\xBB\xBF";
$output = fopen('php://output', 'w');

// Escribir los datos
fputcsv_custom($output, ['Reporte Quincenal de Ventas']);
fputcsv_custom($output, ['Rango:', $fechaInicio . ' → ' . $fechaFin]);
fputcsv_custom($output, ['Mejor Vendedor:', $mejorVendedor['nombre'] . ' (Bs ' . number_format($mejorVendedor['monto_total'], 2, ',', '.') . ')']);
fputcsv_custom($output, ['Total Recaudado:', number_format($totalGeneral, 2, ',', '.') . ' Bs']);
fputcsv_custom($output, []); // Espacio

// Cabecera de tabla
fputcsv_custom($output, ['Producto', 'Cantidad Vendida', 'Monto Recaudado (Bs)', 'Participación (%)']);

// Cuerpo
foreach ($datos as $item) {
    $porcentaje = ($totalGeneral > 0) ? ($item['monto_total'] * 100 / $totalGeneral) : 0;
    fputcsv_custom($output, [
        $item['nombre'],
        $item['cantidad_total'],
        number_format($item['monto_total'], 2, ',', '.'),
        number_format($porcentaje, 2, ',', '.') . '%'
    ]);
}

fclose($output);
exit;


