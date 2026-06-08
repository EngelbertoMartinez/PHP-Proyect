<?php

session_start();

require_once __DIR__ . "/../models/Usuario.php";

$modelo = new Usuario();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$resultado = $modelo->login(
    $usuario,
    $password
);

if ($resultado) {

    $_SESSION['id_usuario'] = $resultado['id_usuario'];

    $_SESSION['usuario'] = $resultado['usuario'];

    $_SESSION['rol'] = $resultado['id_rol'];

    $_SESSION['nombre'] = $resultado['nombre'];

    header(
        "Location:../views/dashboard/dashboard.php"
    );

    exit;

} else {

    header(
        "Location:../views/auth/login.php?error=1"
    );

    exit;

}

?>