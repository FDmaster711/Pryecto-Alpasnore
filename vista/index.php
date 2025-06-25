<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="contenedor">
        <div class="tarjeta-bienvenida">
            <h2 class="titulo-principal">Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></h2>
        </div>

        <div class="seccion-opciones">
            <h3 class="titulo-secundario">Opciones <?= $_SESSION['es_admin'] ? 'de Administrador' : 'del Sistema' ?></h3>
            <ul class="lista-opciones">
                <?php if ($_SESSION['es_admin']): ?>
                    <li><a href="../crear_usuarios.php">Crear nuevo usuario</a></li>
                <?php endif; ?>
                <li><a href="/Artesania_Alpasnore/vista/inventario.php">Gestión de inventario</a></li>
                <li><a href="#">Registro de ventas</a></li>
                <li><a href="#">Reporte y análisis</a></li>
            </ul>
        </div>

        <a href="logout.php" class="boton-cerrar-sesion">Cerrar Sesión</a>
    </div>
</body>
</html>
