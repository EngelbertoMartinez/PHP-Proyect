<?php

require_once __DIR__ . "/../../middleware/VendedorMiddleware.php";
require_once "../../models/Producto.php";

$modelo = new Producto();

$productos = $modelo->listar();

?>

<?php

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <h2>Productos</h2>

    <input type="text" id="buscar" class="form-control mb-3" placeholder="Buscar producto...">

    <a href="crear.php" class="btn btn-success">

        Nuevo producto

    </a>

    <table class="table">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Acciones</th>
            <th></th>

        </tr>

        <tbody id="tablaProductos">

            <?php foreach ($productos as $p): ?>

                <tr>

                    <td>
                        <?= $p['id_producto'] ?>
                    </td>

                    <td>
                        <?= $p['nombre'] ?>
                    </td>

                    <td>
                        <?= $p['precio'] ?>
                    </td>

                    <td>
                        <?= $p['stock'] ?>
                    </td>

                    <td>
                        <?= $p['categoria'] ?>
                    </td>

                    <td>

                        <a href="editar.php?id=<?= $p['id_producto'] ?>" class="btn btn-warning">

                            Editar

                        </a>

                        <a href="../../controllers/ProductoController.php?accion=eliminar&id=<?= $p['id_producto'] ?>"
                            class="btn btn-danger">

                            Eliminar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<script>

    document
        .getElementById(
            "buscar"
        )

        .addEventListener(

            "keyup",

            function () {

                let texto = this.value;

                fetch(

                    "../../controllers/BuscarProductoController.php?buscar=" + texto

                )

                    .then(
                        response => response.text()
                    )

                    .then(

                        data => {

                            document
                                .getElementById(
                                    "tablaProductos"
                                )
                                .innerHTML = data;

                        }

                    );

            }

        );

</script>

<?php

require_once "../layout/footer.php";

?>