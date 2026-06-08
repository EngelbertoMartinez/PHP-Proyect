<?php

require_once __DIR__ . "/../config/conexion.php";

class Producto
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->conectar();
    }

    public function listar()
    {

        $sql = $this->conexion->prepare(
            "SELECT p.*,
        c.nombre as categoria

        FROM productos p
        LEFT JOIN categorias c
        ON p.id_categoria=c.id_categoria"
        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function buscar($texto)
    {

        $sql = $this->conexion->prepare(

            "SELECT p.*,
    c.nombre as categoria

    FROM productos p

    LEFT JOIN categorias c
    ON p.id_categoria=c.id_categoria

    WHERE p.nombre LIKE ?"

        );

        $sql->execute([
            "%" . $texto . "%"
        ]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function obtenerPorId($id)
    {

        $sql = $this->conexion->prepare(
            "SELECT *
        FROM productos
        WHERE id_producto=?"
        );

        $sql->execute([$id]);

        return $sql->fetch(PDO::FETCH_ASSOC);

    }

    public function actualizar(
        $id,
        $nombre,
        $descripcion,
        $precio,
        $stock,
        $categoria
    ) {

        // verificar que la categoría exista

        $verificar = $this->conexion->prepare(

            "SELECT id_categoria
    FROM categorias
    WHERE id_categoria=?"

        );

        $verificar->execute([$categoria]);

        if (!$verificar->fetch()) {

            die(
                "La categoría seleccionada no existe"
            );

        }

        $sql = $this->conexion->prepare(

            "UPDATE productos
    SET

    nombre=?,
    descripcion=?,
    precio=?,
    stock=?,
    id_categoria=?

    WHERE id_producto=?"

        );

        return $sql->execute([

            $nombre,
            $descripcion,
            $precio,
            $stock,
            $categoria,
            $id

        ]);

    }

    public function insertar(
        $nombre,
        $descripcion,
        $precio,
        $stock,
        $categoria
    ) {

        $sql = $this->conexion->prepare(
            "INSERT INTO productos
        (
        nombre,
        descripcion,
        precio,
        stock,
        id_categoria
        )

        VALUES(?,?,?,?,?)"
        );

        return $sql->execute([
            $nombre,
            $descripcion,
            $precio,
            $stock,
            $categoria
        ]);
    }

    public function eliminar($id)
    {

        $sql = $this->conexion->prepare(
            "DELETE FROM productos
        WHERE id_producto=?"
        );

        return $sql->execute([$id]);

    }

}

?>