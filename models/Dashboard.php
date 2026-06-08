<?php

require_once __DIR__ . "/../config/conexion.php";

class Dashboard
{

    private $conexion;

    public function __construct()
    {

        $this->conexion =
            (new Conexion())->conectar();

    }


    public function totalVentas()
    {

        $sql = $this->conexion->prepare(

            "SELECT
IFNULL(SUM(total),0) total
FROM ventas"

        );

        $sql->execute();

        return $sql->fetch();

    }


    public function totalProductos()
    {

        $sql = $this->conexion->prepare(

            "SELECT COUNT(*) total
FROM productos"

        );

        $sql->execute();

        return $sql->fetch();

    }


    public function totalUsuarios()
    {

        $sql = $this->conexion->prepare(

            "SELECT COUNT(*) total
FROM usuarios"

        );

        $sql->execute();

        return $sql->fetch();

    }


    public function inventarioBajo()
    {

        $sql = $this->conexion->prepare(

            "SELECT COUNT(*) total
FROM productos
WHERE stock<=5"

        );

        $sql->execute();

        return $sql->fetch();

    }


    public function ventasPorDia()
    {

        $sql = $this->conexion->prepare(

            "SELECT

DATE(fecha) fecha,
SUM(total) total

FROM ventas

GROUP BY DATE(fecha)

ORDER BY fecha"

        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function productosStockBajo()
    {

        $sql = $this->conexion->prepare(

            "SELECT

id_producto,
nombre,
stock

FROM productos

WHERE stock<=5

ORDER BY stock ASC"

        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>