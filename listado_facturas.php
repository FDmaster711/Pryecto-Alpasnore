<?php
require_once __DIR__ . '/controlador/venta_controlador.php';

$controlador = new VentaControlador();
$controlador->listarFacturas(); // ✅ este método debe existir en tu controlador
