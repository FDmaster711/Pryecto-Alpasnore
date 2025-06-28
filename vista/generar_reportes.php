<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportación de Reportes</title>
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/inventario.css">
</head>
<body>
    <div class="contenedor">
        <div class="tarjeta-bienvenida">
            <h1 class="titulo-principal">📤 Exportación de Reportes</h1>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?>. Desde aquí puedes descargar los reportes quincenales.</p>
        </div>

        <h2 class="titulo-secundario">Formatos disponibles:</h2>

        <ul class="submenu-inventario">
            <li><a href="/Artesania_Alpasnore/exportar_excel.php" target="_blank">📊 Descargar como Excel</a></li>
            <li><a href="/Artesania_Alpasnore/exportar_pdf.php" target="_blank">🧾 Descargar como PDF</a></li>
        </ul>

        <a href="index.php" class="boton-cerrar-sesion">⬅ Volver al panel</a>
    </div>
</body>
</html>

