<?php
session_start();
require_once __DIR__ . '/../modelo/articulo_modelo.php';



class ArticuloControlador {
    public function registrar() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $mensaje = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = trim($_POST['codigo']);
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);
            $precio = str_replace(',', '.', $_POST['precio']);
            $cantidad = intval($_POST['cantidad']);

            if (empty($codigo) || empty($nombre) || empty($precio)) {
                $error = "Código, nombre y precio son campos obligatorios";
            } elseif (!is_numeric($precio) || $precio <= 0) {
                $error = "El precio debe ser un número positivo";
            } elseif (!is_numeric($cantidad) || $cantidad < 0) {
                $error = "La cantidad debe ser un número positivo o cero";
            } elseif (!preg_match('/^\d{1,8}$/', $codigo)) {
                $error = "El código debe ser un número entero de hasta 8 dígitos";
            }
            
            else {
                $modelo = new ArticuloModelo();
                if ($modelo->existeCodigo($codigo)) {
                    $error = "El código de producto ya existe";
                } else {
                    $resultado = $modelo->registrarArticulo($codigo, $nombre, $descripcion, $precio, $cantidad);
                    if (isset($resultado['error'])) {
                        $error = $resultado['error'];
                    } else {
                        $mensaje = $resultado['mensaje'];
                        $_POST = []; // Limpiar formulario
                    }
                }
            }
        }

        include __DIR__ . '/../vista/registrar_articulo.php';
    }
    public function actualizarStock() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $modelo = new ArticuloModelo();
    $articulos = $modelo->obtenerTodos();
    $mensaje = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = intval($_POST['articulo_id']);
        $tipo = $_POST['tipo_movimiento'];
        $cantidad = intval($_POST['cantidad']);
        $motivo = trim($_POST['motivo']);

        if (!$id || $cantidad <= 0) {
            $error = "Debe seleccionar un artículo y una cantidad válida";
        } else {
            $articulo = $modelo->obtenerPorId($id);
            if (!$articulo) {
                $error = "El artículo seleccionado no existe";
            } else {
                $stock_actual = $articulo['cantidad'];
                $nuevo = $tipo === 'entrada'
                    ? $stock_actual + $cantidad
                    : ($cantidad > $stock_actual
                        ? $error = "Stock insuficiente"
                        : $stock_actual - $cantidad);

                if (empty($error) && $modelo->actualizarCantidad($id, $nuevo)) {
                    $mensaje = "Stock actualizado para <strong>{$articulo['nombre']}</strong> (cód: {$articulo['codigo']}). Nuevo stock: <strong>$nuevo</strong>";
                    $articulos = $modelo->obtenerTodos(); // refrescar lista
                } elseif (empty($error)) {
                    $error = "Error al actualizar stock";
                }
            }
        }
    }

    include __DIR__ . '/../vista/actualizar_stock.php';
}
public function consultar() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $modelo = new ArticuloModelo();
    $busqueda = $_GET['busqueda'] ?? '';
    $filtro_stock = $_GET['filtro_stock'] ?? 'todos';
    $articulos = $modelo->buscarArticulos($busqueda, $filtro_stock);

    include __DIR__ . '/../vista/consultar_articulo.php';
}


}
