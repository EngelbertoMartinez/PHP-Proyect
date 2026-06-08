<?php

session_start();

$detalle =
    $_SESSION['detalleVenta'];

require_once __DIR__ . "/../layout/header.php";

?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>

        Detalle venta

    </h2>

    <a href="historial.php" class="btn btn-secondary">

        ← Volver

    </a>

</div>

<table class="table">

    <thead>

        <tr>

            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($detalle as $d): ?>

            <tr>

                <td><?= $d['nombre'] ?></td>

                <td><?= $d['cantidad'] ?></td>

                <td>$<?= $d['precio'] ?></td>

                <td>$<?= $d['subtotal'] ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<?php

unset(
    $_SESSION['detalleVenta']
);

require_once __DIR__ . "/../layout/footer.php";

?>