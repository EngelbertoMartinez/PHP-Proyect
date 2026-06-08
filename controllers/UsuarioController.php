<?php

require_once __DIR__ . "/../models/Usuario.php";

$modelo = new Usuario();

$accion = $_GET['accion'] ?? '';

switch ($accion) {

    case "guardar":

        $modelo->insertar(

            $_POST['nombre'],
            $_POST['usuario'],
            $_POST['correo'],
            $_POST['password'],
            $_POST['rol']

        );

        header(
            "Location:../views/usuarios/index.php"
        );

        exit;

        break;


    case "eliminar":

        $modelo->eliminar(
            $_GET['id']
        );

        header(
            "Location:../views/usuarios/index.php"
        );

        exit;

        break;

    case "actualizar":

        $modelo->actualizar(

            $_POST['id'],
            $_POST['nombre'],
            $_POST['usuario'],
            $_POST['correo'],
            $_POST['password'],
            $_POST['rol']

        );

        header(
            "Location:../views/usuarios/index.php"
        );

        exit;

        break;

}


?>