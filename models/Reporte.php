<?php

require_once __DIR__ . "/../config/conexion.php";

class Reporte
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = (new Conexion())->conectar();

    }

    public function ventas()
    {

        $sql = $this->conexion->prepare(

            "SELECT

v.id_venta,
u.nombre as usuario,
v.fecha,
v.subtotal,
v.iva,
v.descuento,
v.total

FROM ventas v

INNER JOIN usuarios u
ON v.id_usuario=u.id_usuario

ORDER BY v.fecha DESC"

        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>