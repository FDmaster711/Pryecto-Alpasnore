<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Venta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/factura.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="contenedor">
    <h1>Factura de Venta</h1>

    <?php
    $venta = $factura[0]; 
    ?>

    <div class="datos-venta grupo-formulario">
        <p><strong>N° de Venta:</strong> <?= $venta['id'] ?></p>
        <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></p>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($venta['cliente']) ?></p>
        <p><strong>Cédula:</strong> <?= htmlspecialchars($venta['cedula']) ?></p>
    </div>

    <table class="tabla-factura">
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($factura as $item): ?>
                <?php
                    $subtotal = $item['cantidad'] * $item['precio_unitario'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['codigo']) ?></td>
                    <td><?= htmlspecialchars($item['nombre']) ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td><?= number_format($item['precio_unitario'], 2, ',', '.') ?> Bs</td>
                    <td><?= number_format($subtotal, 2, ',', '.') ?> Bs</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" class="total-label">Total:</td>
                <td><strong><?= number_format($total, 2, ',', '.') ?> Bs</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="formulario acciones">
        <a href="/Artesania_Alpasnore/registrar_venta.php" class="boton-secundario">
            <i class="fas fa-plus"></i>
            <span>Nueva Venta</span>
        </a>
        <button onclick="window.print()" class="boton">
            <i class="fas fa-print"></i>
            <span>Imprimir Factura</span>
        </button>
    </div>
</div>
</body>
