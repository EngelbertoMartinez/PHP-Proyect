<?php

session_start();

require_once __DIR__ . "/../../middleware/VendedorMiddleware.php";
require_once "../../models/Producto.php";

$modelo = new Producto();

$productos = $modelo->listar();

$carrito = $_SESSION['carrito'] ?? [];

$total = 0;

foreach ($carrito as $item) {

    $total += $item['subtotal'];

}

$descuento = $_SESSION['descuento'] ?? 0;

$montoDescuento = $total * ($descuento / 100);

$subtotal = $total - $montoDescuento;

$iva = $subtotal * 0.16;

$totalFinal = $subtotal + $iva;

?>

<?php

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <h2>Ventas</h2>

    <?php

    if (isset($_GET['error'])) {

        if ($_GET['error'] == "stock") {

            echo '

<div class="alert alert-danger">

Stock insuficiente

</div>

';

        }

        if ($_GET['error'] == "producto") {

            echo '

<div class="alert alert-danger">

Producto no encontrado

</div>

';

        }

    }

    ?>

    <form action="../../controllers/VentaController.php?accion=agregar" method="POST">

        <select name="id_producto" class="form-control mb-2">

            <?php foreach ($productos as $p): ?>

                <option value="<?= $p['id_producto'] ?>">

                    <?= $p['nombre'] ?>

                    Stock:

                    <?= $p['stock'] ?>

                </option>

            <?php endforeach; ?>

        </select>

        <input type="number" name="cantidad" class="form-control mb-2" placeholder="Cantidad" required>

        <input type="number" name="descuento" class="form-control mb-2" placeholder="Descuento (%)" value="0" min="0"
            max="100">

        <button class="btn btn-primary">

            Agregar

        </button>

    </form>

    <hr>

    <h3>Carrito</h3>

    <table class="table">

        <tr>

            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th>Acciones</th>

        </tr>

        <?php foreach ($carrito as $item):

            $total += $item['subtotal'];

            ?>

            <?php foreach ($carrito as $item): ?>

                <tr>

                    <td>

                        <?= $item['nombre'] ?>

                    </td>

                    <td>

                        <?= $item['cantidad'] ?>

                    </td>

                    <td>

                        $<?= $item['precio'] ?>

                    </td>

                    <td>

                        $<?= $item['subtotal'] ?>

                    </td>

                    <td>

                        <a href="../../controllers/VentaController.php?accion=eliminarCarrito&id=<?= $item['id'] ?>"
                            class="btn btn-danger btn-sm">

                            Eliminar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endforeach; ?>

    </table>

    <hr>

    <h5>

        Subtotal:
        $<?= number_format($total, 2) ?>

    </h5>

    <h5>

        Descuento:
        <?= number_format($descuento, 2) ?> %

        (-$<?= number_format($montoDescuento, 2) ?>)

    </h5>

    <h5>

        IVA (16%):
        $<?= number_format($iva, 2) ?>

    </h5>

    <h3>

        Total final:
        $<?= number_format($totalFinal, 2) ?>

    </h3>

    <br>

    <a href="../../controllers/VentaController.php?accion=vaciarCarrito" class="btn btn-warning">

        Vaciar carrito

    </a>

    <a href="../../controllers/VentaController.php?accion=finalizar" class="btn btn-success">

        Finalizar venta

    </a>

</div>

<?php

require_once "../layout/footer.php";

?>