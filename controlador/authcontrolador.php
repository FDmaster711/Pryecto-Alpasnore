<?php
session_start();
require_once __DIR__ . '/../modelo/modelo_usuario.php';

class AuthControlador {
    public function login() {
        $error = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $modelo = new UsuarioModelo();
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $user = $modelo->obtenerUsuarioPorNombre($username);

            if ($user && (password_verify($password, $user['password']) || $user['password'] === $password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['username'] = $user['usuario'];
                $_SESSION['es_admin'] = $user['es_admin'];
                header("Location: ../vista/index.php");
                exit();
            } else {
                $error = "Credenciales incorrectas";
            }
        }

        include __DIR__ . '/../vista/login.php';
    }
}
