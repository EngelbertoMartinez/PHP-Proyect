<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location:../auth/login.php");
    exit;

}

$esAdmin = ($_SESSION['rol'] == 1);

if ($esAdmin) {

    require_once "../../models/Dashboard.php";

    $modelo = new Dashboard();

    $ventas = $modelo->totalVentas();
    $productos = $modelo->totalProductos();
    $usuarios = $modelo->totalUsuarios();
    $inventario = $modelo->inventarioBajo();
    $alertas = $modelo->productosStockBajo();

    $grafica = $modelo->ventasPorDia();

    $fechas = [];
    $totales = [];

    foreach ($grafica as $g) {

        $fechas[] = $g['fecha'];
        $totales[] = $g['total'];

    }

}

require_once "../layout/header.php";

?>

<?php if ($esAdmin): ?>

    <h2 class="mb-4">

        Dashboard administrativo

    </h2>

    <div class="row">

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h5>Total ventas</h5>

                    <h3>

                        $<?= number_format($ventas['total'], 2) ?>

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h5>Productos</h5>

                    <h3>

                        <?= $productos['total'] ?>

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h5>Usuarios</h5>

                    <h3>

                        <?= $usuarios['total'] ?>

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card">

                <div class="card-body">

                    <h5>Stock bajo</h5>

                    <h3>

                        <?= $inventario['total'] ?>

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="card">

        <div class="card-body">

            <h4>

                Estadísticas de ventas

            </h4>

            <canvas id="ventasChart"></canvas>

        </div>

    </div>

    <br>

    <div class="card">

        <div class="card-body">

            <h4>

                ⚠ Productos con stock bajo

            </h4>

            <?php if (count($alertas) > 0): ?>

                <div class="list-group">

                    <?php foreach ($alertas as $a): ?>

                        <div class="list-group-item">

                            <strong>

                                <?= $a['nombre'] ?>

                            </strong>

                            <br>

                            Quedan:

                            <?= $a['stock'] ?>

                            unidades

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="alert alert-success">

                    No hay productos con stock bajo

                </div>

            <?php endif; ?>

        </div>

    </div>

<?php else: ?>

    <h2>

        Panel de vendedor

    </h2>

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body">

                    <h5>Productos</h5>

                    <p>

                        Administrar productos

                    </p>

                    <a href="../productos/index.php" class="btn btn-primary">

                        Abrir

                    </a>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card">

                <div class="card-body">

                    <h5>Ventas</h5>

                    <p>

                        Registrar ventas

                    </p>

                    <a href="../ventas/index.php" class="btn btn-success">

                        Abrir

                    </a>

                </div>

            </div>

        </div>

    </div>

<?php endif; ?>

<?php if ($esAdmin): ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        new Chart(

            document.getElementById(
                'ventasChart'
            ),

            {

                type: 'bar',

                data: {

                    labels:
                        <?= json_encode($fechas) ?>,

                    datasets: [{

                        label: 'Ventas',

                        data:
                            <?= json_encode($totales) ?>

                    }]

                }

            }

        );

    </script>

<?php endif; ?>

<?php

require_once "../layout/footer.php";

?>