<?php

require_once __DIR__ . "/../../middleware/AdminMiddleware.php";
require_once "../../models/Usuario.php";

$modelo = new Usuario();

$usuarios = $modelo->listar();

?>

<?php

require_once "../layout/header.php";

?>
<div class="container mt-4">

    <h2>Usuarios</h2>

    <a href="crear.php" class="btn btn-success mb-3">

        Nuevo Usuario

    </a>

    <table class="table">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th></th>

        </tr>

        <?php foreach ($usuarios as $u): ?>

            <tr>

                <td>
                    <?= $u['id_usuario'] ?>
                </td>

                <td>
                    <?= $u['nombre'] ?>
                </td>

                <td>
                    <?= $u['usuario'] ?>
                </td>

                <td>
                    <?= $u['correo'] ?>
                </td>

                <td>
                    <?= $u['rol'] ?>
                </td>

                <td>

                    <a href="editar.php?id=<?= $u['id_usuario'] ?>" class="btn btn-warning">

                        Editar

                    </a>

                    <a href="../../controllers/UsuarioController.php?accion=eliminar&id=<?= $u['id_usuario'] ?>"
                        class="btn btn-danger">

                        Eliminar

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>

<?php

require_once "../layout/footer.php";

?>