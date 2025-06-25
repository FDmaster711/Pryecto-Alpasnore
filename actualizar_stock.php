<?php
require_once __DIR__ . '/controlador/articulo_controlador.php';
$controlador = new ArticuloControlador();
$controlador->actualizarStock();
