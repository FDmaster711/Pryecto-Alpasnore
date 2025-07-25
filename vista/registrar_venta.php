<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/venta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="contenedor">
    <h1>Registrar Venta</h1>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="formulario">
        <div class="grupo-formulario">
            <label for="articulo_id">Producto:</label>
            <select name="articulo_id" id="articulo_id" required>
                <option value="">Seleccione un artículo</option>
                <?php foreach ($articulos as $art): ?>
                    <option value="<?= $art['id'] ?>"><?= htmlspecialchars($art['nombre']) ?> (<?= $art['codigo'] ?>) - Stock: <?= $art['cantidad'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grupo-formulario">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required>
        </div>

        <button type="submit" name="agregar" class="boton">
            <i class="fas fa-cart-plus"></i>
            <span>Agregar al carrito</span>
        </button>

        <button type="submit" name="limpiar" class="boton-secundario">
            <i class="fas fa-trash-can"></i>
            <span>Limpiar carrito</span>
        </button>
    </form>

    <!-- Carrito actual -->
    <h2>Carrito</h2>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['carrito'] as $item):
                    $subtotal = $item['cantidad'] * $item['precio'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['codigo']) ?></td>
                        <td><?= htmlspecialchars($item['nombre']) ?></td>
                        <td><?= $item['cantidad'] ?></td>
                        <td><?= number_format($item['precio'], 2,',', '.') ?>Bs</td>
                        <td><?= number_format($subtotal, 2,',', '.') ?>Bs</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="total-label">Total</td>
                    <td><strong><?= number_format($total, 2,',', '.') ?>Bs</strong></td>
                </tr>
            </tbody>
        </table>

        <form method="POST" class="formulario">
            <div class="grupo-formulario">
                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" id="cliente" placeholder="Nombre del cliente" required>
            </div>
            <div class="grupo-formulario">
                <label for="cedula">Cédula:</label>
                <input type="text" name="cedula" id="cedula" placeholder="Ej: V-12345678" required>
            </div>
            <button type="submit" name="confirmar" class="boton-confirmar">
                <i class="fas fa-receipt"></i>
                <span>Confirmar Venta</span>
            </button>
        </form>
    <?php else: ?>
        <p>No hay productos en el carrito aún.</p>
    <?php endif; ?>

    <a href="/Artesania_Alpasnore/vista/index.php" class="boton-secundario">
        <i class="fas fa-house"></i>
        <span>Volver al Menú</span>
    </a>

    <a href="/Artesania_Alpasnore/listado_facturas.php" class="boton-3">
        <i class="fas fa-file-invoice"></i>
        <span>Ver Registro de Facturas</span>
    </a>
</div>
</body>
</html>