<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/registrar.css">
</head>
<body>
    <div class="contenedor">
        <h1>Registrar Nuevo Producto</h1>

        <?php if (!empty($error)): ?>
            <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje-exito"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>
 

        <form method="POST" action="/Artesania_Alpasnore/registrar_articulo.php" class="formulario">
            <div class="grupo-formulario">
                <label for="codigo">Código del Producto:</label>
                <input type="text" id="codigo" name="codigo" value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" required>
                <small>Identificador único del producto</small>
            </div>

            <div class="grupo-formulario">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
            </div>

            <div class="grupo-formulario">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
            </div>

            <div class="grupo-formulario">
                <label for="precio">Precio Unitario:</label>
                <input type="text" id="precio" name="precio" value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>" required>
                <small>Formato: 1.999,99</small>
            </div>

            <div class="grupo-formulario">
                <label for="cantidad">Cantidad Inicial:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?= htmlspecialchars($_POST['cantidad'] ?? '0') ?>" min="0">
            </div>

            <button type="submit" class="boton">Registrar Producto</button>
        </form>

        <a href="/Artesania_Alpasnore/vista/inventario.php" class="boton-secundario">← Volver al Inventario</a>
    </div>
</body>
</html>
