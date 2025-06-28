<?php
require_once __DIR__ . '/modelo/modelo_venta.php';
require_once __DIR__ . '/dompdf/autoload.inc.php'; // O ajustá según tu estructura

use Dompdf\Dompdf;
use Dompdf\Options;

$ventaModelo = new VentaModelo();
$fechaFin = date('Y-m-d');
$fechaInicio = date('Y-m-d', strtotime('-15 days'));

$datos = $ventaModelo->obtenerDetalleProductosConMonto($fechaInicio, $fechaFin);
$mejorVendedor = $ventaModelo->obtenerMejorVendedor($fechaInicio, $fechaFin);
$totalGeneral = array_sum(array_column($datos, 'monto_total'));

// Comenzamos el HTML del PDF
$html = "
    <h2 style='text-align:center'> Reporte Quincenal de Ventas</h2>
    <p><strong>Rango:</strong> {$fechaInicio}  {$fechaFin}</p>
    <p><strong>Mejor Vendedor:</strong> {$mejorVendedor['nombre']} (Bs " . number_format($mejorVendedor['monto_total'], 2, ',', '.') . ")</p>
    <p><strong>Total Recaudado:</strong> Bs " . number_format($totalGeneral, 2, ',', '.') . "</p>
    <br>
    <table style='width:100%; border-collapse:collapse;' border='1'>
        <thead>
            <tr style='background-color:#f0f0f0;'>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Monto Recaudado (Bs)</th>
                <th>Participación (%)</th>
            </tr>
        </thead>
        <tbody>";
foreach ($datos as $item) {
    $porcentaje = ($totalGeneral > 0) ? ($item['monto_total'] * 100 / $totalGeneral) : 0;
    $html .= "<tr>
                <td>{$item['nombre']}</td>
                <td style='text-align:center'>{$item['cantidad_total']}</td>
                <td style='text-align:right'>" . number_format($item['monto_total'], 2, ',', '.') . "</td>
                <td style='text-align:right'>" . number_format($porcentaje, 2, ',', '.') . "%</td>
             </tr>";
}
$html .= "</tbody></table>";

$options = new Options();
$options->set('defaultFont', 'Arial');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_quincenal_" . date('Ymd') . ".pdf", ["Attachment" => true]);
