<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/modelo/modelo_venta.php';

$ventaModelo = new VentaModelo();
$fechaFin = date('Y-m-d');
$fechaInicio = date('Y-m-d', strtotime('-15 days'));


$datos = $ventaModelo->obtenerDetalleProductosConMonto($fechaInicio, $fechaFin);


$mejorVendedor = $ventaModelo->obtenerMejorVendedor($fechaInicio, $fechaFin);


$totalGeneral = array_sum(array_column($datos, 'monto_total'));

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=reporte_quincenal_' . date('Ymd') . '.csv');

$output = fopen('php://output', 'w');


fputcsv($output, ['Reporte Quincenal de Ventas']);
fputcsv($output, ['Rango:', $fechaInicio . ' → ' . $fechaFin]);
fputcsv($output, ['Mejor Vendedor:', $mejorVendedor['nombre'] . ' (Bs ' . number_format($mejorVendedor['monto_total'], 2, ',', '.') . ')']);
fputcsv($output, ['Total Recaudado:', number_format($totalGeneral, 2, ',', '.') . ' Bs']);
fputcsv($output, []); // Espacio

// Cabecera de tabla
fputcsv($output, ['Producto', 'Cantidad Vendida', 'Monto Recaudado (Bs)', 'Participación (%)']);

// Cuerpo
foreach ($datos as $item) {
    $porcentaje = ($totalGeneral > 0) ? ($item['monto_total'] * 100 / $totalGeneral) : 0;
    fputcsv($output, [
        $item['nombre'],
        $item['cantidad_total'],
        number_format($item['monto_total'], 2, ',', '.'),
        number_format($porcentaje, 2, ',', '.') . '%'
    ]);
}

fclose($output);
exit;

