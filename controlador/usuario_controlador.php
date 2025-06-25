<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../modelo/modelo_usuario.php';

class UsuarioControlador {
    public function crear() {
        if (!isset($_SESSION['user_id']) || !$_SESSION['es_admin']) {
            header("Location: login.php");
            exit();
        }

        $error = null;
        $success = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = trim($_POST["username"]);
            $nombre = $_POST["nombre"];
            $password = $_POST["password"];
            $es_admin = isset($_POST["es_admin"]) ? 1 : 0;

            if (empty($username) || empty($password)) {
                $error = "Todos los campos son obligatorios";
            } elseif (strlen($password) < 8) {
                $error = "La contraseña debe tener al menos 8 caracteres";
            } else {
                $modelo = new UsuarioModelo();
                $resultado = $modelo->crearUsuario($username, $password, $nombre, $es_admin);

                if (isset($resultado["error"])) {
                    $error = $resultado["error"];
                } else {
                    $success = $resultado["success"];
                }
            }
        }

        include __DIR__ . '/../vista/usuarios.php';
    }
}
