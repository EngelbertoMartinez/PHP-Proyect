<?php

require_once __DIR__ . "/../config/conexion.php";

class Categoria
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = (new Conexion())->conectar();

    }

    public function listar()
    {

        $sql = $this->conexion->prepare(
            "SELECT * FROM categorias"
        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar($nombre)
    {

        $sql = $this->conexion->prepare(
            "INSERT INTO categorias(nombre)
        VALUES(?)"
        );

        return $sql->execute([$nombre]);

    }

    public function eliminar($id)
    {

        $sql = $this->conexion->prepare(
            "DELETE FROM categorias
        WHERE id_categoria=?"
        );

        return $sql->execute([$id]);

    }

    public function obtenerPorId($id)
    {

        $sql = $this->conexion->prepare(

            "SELECT *
    FROM categorias
    WHERE id_categoria=?"

        );

        $sql->execute([$id]);

        return $sql->fetch(PDO::FETCH_ASSOC);

    }


    public function actualizar(
        $id,
        $nombre
    ) {

        $sql = $this->conexion->prepare(

            "UPDATE categorias
    SET nombre=?
    WHERE id_categoria=?"

        );

        return $sql->execute([

            $nombre,
            $id

        ]);

    }

}

?>