<?php

session_start();

require_once "../models/Venta.php";

$modelo = new Venta();

$accion = $_GET['accion'];

switch ($accion) {

    case "detalle":

        $_SESSION['detalleVenta'] =

            $modelo->detalle(
                $_GET['id']
            );

        header(

            "Location:../views/ventas/detalle.php"

        );

        exit;

        break;

}