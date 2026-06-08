<?php

require_once __DIR__ . "/../config/conexion.php";

class Venta
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = (new Conexion())->conectar();

    }

    public function registrarVenta(
        $total,
        $usuario
    ) {

        $sql = $this->conexion->prepare(

            "INSERT INTO ventas
            (
            subtotal,
            iva,
            descuento,
            total,
            id_usuario
            )

            VALUES(
            ?,?,?,?,
            ?
            )"

        );

        $descuento =
            $_SESSION['descuento'] ?? 0;

        $subtotal =
            $total / (1.16);

        $iva =
            $total - $subtotal;

        $sql->execute([

            $subtotal,
            $iva,
            $descuento,
            $total,
            $usuario

        ]);

        return $this->conexion->lastInsertId();

    }

    public function detalleVenta(
        $idVenta,
        $idProducto,
        $cantidad,
        $subtotal
    ) {

        $sql = $this->conexion->prepare(
            "INSERT INTO detalle_ventas
        (
        id_venta,
        id_producto,
        cantidad,
        subtotal
        )

        VALUES(?,?,?,?)"
        );

        return $sql->execute([
            $idVenta,
            $idProducto,
            $cantidad,
            $subtotal
        ]);

    }

    public function actualizarInventario(
        $idProducto,
        $cantidad
    ) {

        $sql = $this->conexion->prepare(
            "UPDATE productos
        SET stock=stock-?
        WHERE id_producto=?"
        );

        return $sql->execute([
            $cantidad,
            $idProducto
        ]);

    }

    public function historial()
    {

        $sql = $this->conexion->prepare(

            "SELECT

v.id_venta,
v.fecha,
v.total,
u.nombre as usuario

FROM ventas v

INNER JOIN usuarios u
ON v.id_usuario=u.id_usuario

ORDER BY v.id_venta DESC"

        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }


    public function detalle($idVenta)
    {

        $sql = $this->conexion->prepare(

            "SELECT

p.nombre,
dv.cantidad,
dv.subtotal,
p.precio

FROM detalle_ventas dv

INNER JOIN productos p
ON dv.id_producto=p.id_producto

WHERE dv.id_venta=?"

        );

        $sql->execute([$idVenta]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

}


?>