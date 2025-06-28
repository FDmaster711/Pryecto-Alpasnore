<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Artículos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/consulta.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="contenedor">
        <h1>Consultar Artículos</h1>

        <form method="GET" action="/Artesania_Alpasnore/consultar_articulo.php" class="formulario-busqueda">
            <div class="grupo-busqueda">
                <label for="busqueda">Buscar:</label>
                <input type="text" id="busqueda" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Código o nombre del artículo">
            </div>

            <div class="grupo-busqueda">
                <label for="filtro_stock">Filtrar por stock:</label>
                <select id="filtro_stock" name="filtro_stock">
                    <option value="todos" <?= $filtro_stock === 'todos' ? 'selected' : '' ?>>Todos los artículos</option>
                    <option value="disponible" <?= $filtro_stock === 'disponible' ? 'selected' : '' ?>>Stock disponible</option>
                    <option value="bajo" <?= $filtro_stock === 'bajo' ? 'selected' : '' ?>>Stock bajo (&lt;10 unidades)</option>
                    <option value="agotado" <?= $filtro_stock === 'agotado' ? 'selected' : '' ?>>Agotados</option>
                </select>
            </div>

            <button type="submit" class="boton boton-buscar">
                <i class="fas fa-search"></i>
                <span>Buscar</span>
            </button>
        </form>

        <div class="contenedor-tabla">
            <?php if (!empty($articulos)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articulos as $articulo): ?>                            <tr>
                            <td><?= htmlspecialchars($articulo['codigo']) ?></td>
                            <td><?= htmlspecialchars($articulo['nombre']) ?></td>
                            <td class="<?= $articulo['cantidad'] == 0 ? 'stock-agotado' : ($articulo['cantidad'] < 10 ? 'stock-bajo' : '') ?>">
                                <?= $articulo['cantidad'] ?>
                            </td>
                            <td><?= number_format($articulo['precio'], 2, ',', '.') ?>Bs</td>
                               <td>
                                    <a href="/Artesania_Alpasnore/actualizar_stock.php?id=<?= $articulo['id'] ?>" class="boton-secundario">
                                        <i class="fas fa-pen-to-square"></i>
                                        <span>Editar</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="total-resultados">Mostrando <?= count($articulos) ?> artículo(s)</p>
            <?php else: ?>
                <div class="mensaje-error">No se encontraron artículos con los criterios de búsqueda</div>
            <?php endif; ?>
        </div>

        <div class="acciones">
            <a href="/Artesania_Alpasnore/vista/inventario.php" class="boton-secundario">
                <i class="fa-solid fa-reply"></i>
                <span>Volver al Inventario</span>
            </a>
            <?php if (!empty($_SESSION['es_admin'])): ?>
                <a href="/Artesania_Alpasnore/registrar_articulo.php" class="boton">
                    <i class="fas fa-plus"></i>
                    <span>Agregar Nuevo Artículo</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
