<?php

$archivo = __DIR__ . DIRECTORY_SEPARATOR . "AuthMiddleware.php";

if (!file_exists($archivo)) {
    die("No existe: " . $archivo);
}

require_once $archivo;

if (
    $_SESSION['rol'] != 1 &&
    $_SESSION['rol'] != 2
) {

    die("Acceso denegado");

}

?>