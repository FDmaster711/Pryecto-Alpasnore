<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/stock.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="contenedor">
        <h1>Actualizar Stock</h1>

        <?php if (!empty($error)): ?>
            <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje-exito"><?= $mensaje ?></div>
        <?php endif; ?>

        <form method="POST" action="/Artesania_Alpasnore/actualizar_stock.php" class="formulario">
            <div class="grupo-formulario">
                <label for="articulo_id">Artículo:</label>
                <select id="articulo_id" name="articulo_id" required>
                    <option value="">Seleccione un artículo</option>
                    <?php foreach ($articulos as $art): ?>
                        <option value="<?= $art['id'] ?>" <?= isset($id) && $id == $art['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($art['nombre']) ?> (Cód: <?= htmlspecialchars($art['codigo']) ?>) - Stock: <?= $art['cantidad'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="tipo_movimiento">Tipo de Movimiento:</label>
                <select id="tipo_movimiento" name="tipo_movimiento" required>
                    <option value="entrada">Entrada (Añadir stock)</option>
                    <option value="salida">Salida (Quitar stock)</option>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" required>
            </div>

            <div class="grupo-formulario">
                <label for="motivo">Motivo:</label>
                <input type="text" id="motivo" name="motivo" placeholder="Ej: Compra, Venta, Ajuste">
            </div>

            <button type="submit" class="boton">Actualizar Stock</button>
        </form>

        <a href="/Artesania_Alpasnore/vista/inventario.php" class="boton-secundario">
            <i class="fa-solid fa-reply"></i>
            <span>Volver al Inventario</span>
        </a>
    </div>
</body>
</html>
