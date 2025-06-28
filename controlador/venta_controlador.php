<?php
session_start();
require_once __DIR__ . '/../modelo/modelo_venta.php';
require_once __DIR__ . '/../modelo/articulo_modelo.php';

class VentaControlador {

    public function registrar() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $modeloArt = new ArticuloModelo();
        $articulos = $modeloArt->obtenerTodos();

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Función auxiliar para contar cuántas unidades ya hay en el carrito de ese artículo
        function cantidadEnCarrito($id) {
            $total = 0;
            foreach ($_SESSION['carrito'] as $item) {
                if ($item['id'] == $id) {
                    $total += $item['cantidad'];
                }
            }
            return $total;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['agregar'])) {
                $id = $_POST['articulo_id'];
                $cantidad = intval($_POST['cantidad']);

                $articulo = $modeloArt->obtenerPorId($id);
                $yaEnCarrito = cantidadEnCarrito($id);

                if ($articulo && $cantidad > 0 && ($yaEnCarrito + $cantidad) <= $articulo['cantidad']) {
                    $_SESSION['carrito'][] = [
                        'id' => $articulo['id'],
                        'nombre' => $articulo['nombre'],
                        'codigo' => $articulo['codigo'],
                        'precio' => $articulo['precio'],
                        'cantidad' => $cantidad
                    ];
                } else {
                    $error = "No hay suficiente stock disponible para ese producto.";
                }
            }

            if (isset($_POST['confirmar'])) {
                $cliente = trim($_POST['cliente']);
                $cedula = trim($_POST['cedula']); 
                $carrito = $_SESSION['carrito'];
                $usuario_id = $_SESSION['user_id'];

                if (count($carrito) > 0 && !empty($cliente) && !empty($cedula)) {
                    $modeloVenta = new VentaModelo();
                    $venta_id = $modeloVenta->registrarVenta($cliente, $cedula, $carrito, $usuario_id); // ✅ con cédula

                    if ($venta_id) {
                        $_SESSION['carrito'] = [];
                        header("Location: factura.php?id=$venta_id");
                        exit();
                    } else {
                        $error = "Error al registrar la venta";
                    }
                } else {
                    $error = "Debes ingresar cliente, cédula y al menos un producto";
                }
            }

            if (isset($_POST['limpiar'])) {
                $_SESSION['carrito'] = [];
            }
        }

        include __DIR__ . '/../vista/registrar_venta.php';
    }

    public function mostrarFactura($id_venta) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $modeloVenta = new VentaModelo();
        $factura = $modeloVenta->obtenerFactura($id_venta);

        if (empty($factura)) {
            echo "Venta no encontrada.";
            exit();
        }

        include __DIR__ . '/../vista/factura.php';
    }

    public function listarFacturas() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $modeloVenta = new VentaModelo();
    $facturas = $modeloVenta->obtenerTodasLasFacturas();

    include __DIR__ . '/../vista/listado_facturas.php';
}




}


