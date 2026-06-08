<?php

require_once __DIR__ . "/../models/Categoria.php";

$modelo = new Categoria();

$accion = $_GET['accion'] ?? '';

switch ($accion) {

    case "guardar":

        $modelo->insertar(
            $_POST['nombre']
        );

        header(
            "Location:../views/categorias/index.php"
        );

        exit;

        break;


    case "eliminar":

        $modelo->eliminar(
            $_GET['id']
        );

        header(
            "Location:../views/categorias/index.php"
        );

        exit;

        break;

    case "actualizar":

        $modelo->actualizar(

            $_POST['id'],
            $_POST['nombre']

        );

        header(
            "Location:../views/categorias/index.php"
        );

        exit;

        break;

}

?>