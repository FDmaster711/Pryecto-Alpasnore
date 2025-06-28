<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Facturas</title>
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/factura.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="contenedor">
    <h1>Historial de Facturas</h1>

    <table class="tabla-factura">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Cédula</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?= $factura['id'] ?></td>
                <td><?= date('d/m/Y H:i', strtotime($factura['fecha'])) ?></td>
                <td><?= htmlspecialchars($factura['cliente']) ?></td>
                <td><?= htmlspecialchars($factura['cedula']) ?></td>
                <td><?= number_format($factura['total'], 2, ',', '.') ?> Bs</td>
                <td>
                    <a class="boton boton-icono" href="factura.php?id=<?= $factura['id'] ?>" title="Ver Factura">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="registrar_venta.php" class="boton-secundario">
        <i class="fas fa-plus"></i>
        <span>Nueva Venta</span>
    </a>
</div>
</body>
</html>

