<?php

session_start();

require_once "../../models/Venta.php";

$modelo = new Venta();

$ventas = $modelo->historial();

require_once "../layout/header.php";

?>

<h2>

    Historial de ventas

</h2>

<table class="table">

    <tr>

        <th>ID</th>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Total</th>
        <th>Acciones</th>

    </tr>

    <?php foreach ($ventas as $v): ?>

        <tr>

            <td>

                <?= $v['id_venta'] ?>

            </td>

            <td>

                <?= $v['fecha'] ?>

            </td>

            <td>

                <?= $v['usuario'] ?>

            </td>

            <td>

                $
                <?= $v['total'] ?>

            </td>

            <td>

                <a href="../../controllers/HistorialController.php?accion=detalle&id=<?= $v['id_venta'] ?>"
                    class="btn btn-primary">

                    Ver detalle

                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php require_once "../layout/footer.php"; ?>