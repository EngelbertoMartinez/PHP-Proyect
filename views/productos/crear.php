<?php

require_once "../../models/Categoria.php";

$modelo = new Categoria();

$categorias = $modelo->listar();

?>

<!DOCTYPE html>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <h2>Nuevo Producto</h2>

        <form action="../../controllers/ProductoController.php?accion=guardar" method="POST">

            <input class="form-control mb-2" name="nombre" placeholder="Nombre" required>

            <textarea class="form-control mb-2" name="descripcion"></textarea>

            <input class="form-control mb-2" name="precio" type="number" step=".01" required>

            <input class="form-control mb-2" name="stock" type="number" required>

            <select class="form-control mb-3" name="categoria">

                <?php foreach ($categorias as $c): ?>

                    <option value="<?= $c['id_categoria'] ?>">

                        <?= $c['nombre'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <button class="btn btn-primary">

                Guardar

            </button>

        </form>

    </div>

</body>

</html>