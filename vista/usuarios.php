<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Artesania_Alpasnore/css/usuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="contenedor-principal">
        <h1 class="titulo-pagina">Crear Nuevo Usuario</h1>

        <?php if (isset($error)): ?>
            <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
        <?php elseif (isset($success)): ?>
            <div class="mensaje-exito"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" class="formulario-creacion">
            <div class="grupo-formulario">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" class="campo-formulario" placeholder="Ej: Juan Pérez" required>
            </div>

            <div class="grupo-formulario">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="campo-formulario" placeholder="Ej: admin" required>
            </div>

            <div class="grupo-formulario">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="campo-formulario" placeholder="Mínimo 8 caracteres" required minlength="8">
            </div>

            <div class="grupo-checkbox">
                <input type="checkbox" id="es_admin" name="es_admin">
                <label for="es_admin">¿Es administrador?</label>
            </div>

            <button type="submit" class="boton-primario">Crear Usuario</button>
        </form>

        <!-- Enlace visual con ícono para volver al panel -->
        <a href="/Artesania_Alpasnore/vista/index.php" class="enlace-volver" title="Volver al panel">
            <i class="fas fa-house"></i>
            <span>Volver al panel</span>
        </a>
    </div>
</body>
</html>