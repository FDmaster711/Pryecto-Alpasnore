<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Alpasnore</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Inicia Sesión</h2>
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" class="login-form">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="login-button">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
