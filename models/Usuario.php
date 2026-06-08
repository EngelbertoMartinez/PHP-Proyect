<?php

require_once __DIR__ . "/../config/conexion.php";

class Usuario
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = (new Conexion())->conectar();

    }

    public function login(
        $usuario,
        $password
    ) {

        $sql = $this->conexion->prepare(

            "SELECT *
FROM usuarios
WHERE usuario=?
AND password=SHA2(?,256)"

        );

        $sql->execute([
            $usuario,
            $password
        ]);

        return $sql->fetch();

    }


    public function listar()
    {

        $sql = $this->conexion->prepare(

            "SELECT u.*,
r.nombre as rol

FROM usuarios u
INNER JOIN roles r

ON u.id_rol=r.id_rol"

        );

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }


    public function insertar(

        $nombre,
        $usuario,
        $correo,
        $password,
        $rol

    ) {

        $sql = $this->conexion->prepare(

            "INSERT INTO usuarios
(
nombre,
usuario,
correo,
password,
id_rol
)

VALUES(
?,
?,
?,
SHA2(?,256),
?
)"

        );

        return $sql->execute([

            $nombre,
            $usuario,
            $correo,
            $password,
            $rol

        ]);

    }


    public function eliminar($id)
    {

        $sql = $this->conexion->prepare(

            "DELETE FROM usuarios
WHERE id_usuario=?"

        );

        return $sql->execute([$id]);

    }

    public function obtenerPorId($id)
    {

        $sql = $this->conexion->prepare(

            "SELECT *
FROM usuarios
WHERE id_usuario=?"

        );

        $sql->execute([$id]);

        return $sql->fetch(PDO::FETCH_ASSOC);

    }


    public function actualizar(

        $id,
        $nombre,
        $usuario,
        $correo,
        $password,
        $rol

    ) {

        if (!empty($password)) {

            $sql = $this->conexion->prepare(

                "UPDATE usuarios

SET

nombre=?,
usuario=?,
correo=?,
password=SHA2(?,256),
id_rol=?

WHERE id_usuario=?"

            );

            return $sql->execute([

                $nombre,
                $usuario,
                $correo,
                $password,
                $rol,
                $id

            ]);

        } else {

            $sql = $this->conexion->prepare(

                "UPDATE usuarios

SET

nombre=?,
usuario=?,
correo=?,
id_rol=?

WHERE id_usuario=?"

            );

            return $sql->execute([

                $nombre,
                $usuario,
                $correo,
                $rol,
                $id

            ]);

        }

    }

}
?>