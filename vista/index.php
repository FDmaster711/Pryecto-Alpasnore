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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                    <li>
                        <a href="../crear_usuarios.php" title="Crear nuevo usuario">
                            <i class="fas fa-user-gear"></i><br>
                            <span>Usuarios</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="/Artesania_Alpasnore/vista/inventario.php" title="Gestión de inventario">
                        <i class="fas fa-warehouse"></i><br>
                        <span>Inventario</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/Artesania_Alpasnore/registrar_venta.php" title="Registro de ventas">
                        <i class="fas fa-cash-register"></i><br>
                        <span>Ventas</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="Reporte y análisis">
                        <i class="fas fa-chart-line"></i><br>
                        <span>Reportes</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="seccion-logout">
            <a href="logout.php" class="boton-cerrar-sesion" title="Cerrar sesión">
                <i class="fas fa-right-from-bracket"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </div>
</body>
</html>