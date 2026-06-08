<?php

require_once __DIR__ . "/../../middleware/AdminMiddleware.php";
require_once "../../models/Categoria.php";

$modelo = new Categoria();

$categorias = $modelo->listar();

?>

<?php

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <h2>Categorías</h2>

    <a href="crear.php" class="btn btn-success mb-3">

        Nueva categoría

    </a>

    <table class="table">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th></th>

        </tr>

        <?php foreach ($categorias as $c): ?>

            <tr>

                <td>
                    <?= $c['id_categoria'] ?>
                </td>

                <td>
                    <?= $c['nombre'] ?>
                </td>

                <td>

                    <a href="editar.php?id=<?= $c['id_categoria'] ?>" class="btn btn-warning">

                        Editar

                    </a>

                    <a href="../../controllers/CategoriaController.php?accion=eliminar&id=<?= $c['id_categoria'] ?>"
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