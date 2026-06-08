<?php

session_start();

require_once __DIR__ . "/../models/Venta.php";
require_once __DIR__ . "/../models/Producto.php";

$accion = $_GET['accion'] ?? '';

if (!isset($_SESSION['carrito'])) {

    $_SESSION['carrito'] = [];

}

switch ($accion) {

    case "agregar":

        $id = $_POST['id_producto'];

        $cantidad = $_POST['cantidad'];

        $modeloProducto = new Producto();

        $producto = $modeloProducto->obtenerPorId($id);

        if (!$producto) {

            header(
                "Location:../views/ventas/index.php?error=producto"
            );

            exit;

        }

        if ($cantidad > $producto['stock']) {

            header(
                "Location:../views/ventas/index.php?error=stock"
            );

            exit;

        }

        $_SESSION['descuento'] =
            $_POST['descuento'] ?? 0;

        $_SESSION['carrito'][] = [

            "id" => $producto['id_producto'],
            "nombre" => $producto['nombre'],
            "precio" => $producto['precio'],
            "cantidad" => $cantidad,
            "subtotal" => $producto['precio'] * $cantidad

        ];

        header(
            "Location:../views/ventas/index.php"
        );

        exit;

        break;


    case "finalizar":

        $total = 0;

        foreach ($_SESSION['carrito'] as $item) {

            $total += $item['subtotal'];

        }

        $descuento = $_SESSION['descuento'] ?? 0;

        $montoDescuento =
            $total * ($descuento / 100);

        $subtotal =
            $total - $montoDescuento;

        $iva =
            $subtotal * 0.16;

        $totalFinal =
            $subtotal + $iva;

        $venta = new Venta();

        $idVenta = $venta->registrarVenta(

            $totalFinal,
            $_SESSION['id_usuario']

        );

        foreach ($_SESSION['carrito'] as $item) {

            $venta->detalleVenta(

                $idVenta,
                $item['id'],
                $item['cantidad'],
                $item['subtotal']

            );

            $venta->actualizarInventario(

                $item['id'],
                $item['cantidad']

            );

        }

        $_SESSION['carrito'] = [];
        $_SESSION['descuento'] = 0;

        header(
            "Location:../views/ventas/index.php?ok=1"
        );

        exit;

        break;


    case "vaciar":

        $_SESSION['carrito'] = [];

        header(
            "Location:../views/ventas/index.php"
        );

        break;

    case "eliminarCarrito":

        $id = $_GET['id'];

        foreach ($_SESSION['carrito'] as $indice => $item) {

            if ($item['id'] == $id) {

                unset(
                    $_SESSION['carrito'][$indice]
                );

            }

        }

        $_SESSION['carrito'] = array_values(
            $_SESSION['carrito']
        );

        header(
            "Location:../views/ventas/index.php"
        );

        exit;

        break;



    case "vaciarCarrito":

        $_SESSION['carrito'] = [];

        $_SESSION['descuento'] = 0;

        header(
            "Location:../views/ventas/index.php"
        );

        exit;

        break;

}