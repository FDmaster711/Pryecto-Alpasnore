<?php
session_start();
// Verificar si el usuario está logueado
if(!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/inventario.css">
</head>
<body>
    <div class="contenedor">
        <div class="tarjeta-bienvenida">
            <h1 class="titulo-principal">Gestión de Inventario</h1>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></p>
        </div>
        
        <h2 class="titulo-secundario">Opciones disponibles:</h2>
        
        <ul class="submenu-inventario">
            <li><a href="/Artesania_Alpasnore/registrar_articulo.php">Registrar nuevo artículo</a></li>
            <li><a href="/Artesania_Alpasnore/actualizar_stock.php">Actualizar stock</a></li>
            <li><a href="/Artesania_Alpasnore/consultar_articulo.php">Consultar Articulo</a></li>
        </ul>
        
        <a href="index.php" class="boton-cerrar-sesion">Volver al panel</a>
    </div>
</body>
</html>