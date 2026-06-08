<?php

require_once __DIR__ . "/../models/Producto.php";

$modelo = new Producto();

$accion = $_GET['accion'] ?? '';

switch ($accion) {

    case "guardar":

        $modelo->insertar(
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['stock'],
            $_POST['categoria']
        );

        header(
            "Location:../views/productos/index.php"
        );
        exit;

        break;

    case "eliminar":

        $modelo->eliminar(
            $_GET['id']
        );

        header(
            "Location:../views/productos/index.php"
        );
        exit;

        break;

    case "actualizar":

        $modelo->actualizar(

            $_POST["id"],
            $_POST["nombre"],
            $_POST["descripcion"],
            $_POST["precio"],
            $_POST["stock"],
            $_POST["categoria"]
        );

        header(
            "Location:../views/productos/index.php"
        );

        exit;

        break;
}

?>