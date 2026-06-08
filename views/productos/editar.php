<?php

require_once "../../models/Producto.php";
require_once "../../models/Categoria.php";

$modelo = new Producto();
$modeloCategoria = new Categoria();

$producto =
    $modelo->obtenerPorId($_GET["id"]);

$categorias =
    $modeloCategoria->listar();

?>

<?php

session_start();

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>

            Editar producto

        </h2>

        <a href="index.php" class="btn btn-secondary">

            ← Volver

        </a>

    </div>

    <form action="../../controllers/ProductoController.php?accion=actualizar" method="POST">

        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id_producto']) ?>">

        <input class="form-control mb-2" name="nombre" value="<?= $producto['nombre'] ?>" required>

        <textarea class="form-control mb-2" name="descripcion"><?= $producto['descripcion'] ?></textarea>

        <input class="form-control mb-2" name="precio" type="number" step=".01" value="<?= $producto['precio'] ?>"
            required>

        <input class="form-control mb-2" name="stock" type="number" value="<?= $producto['stock'] ?>" required>

        <select class="form-control mb-3" name="categoria">

            <?php foreach ($categorias as $c): ?>

                <option value="<?= htmlspecialchars($c['id_categoria']) ?>"
                    <?= ($c['id_categoria'] == $producto['id_categoria']) ? 'selected' : '' ?>>

                    <?= $c['nombre'] ?>

                </option>

            <?php endforeach; ?>

        </select>

        <button class="btn btn-primary">

            Actualizar

        </button>

    </form>

</div>

<?php

require_once "../layout/footer.php";

?>