<?php

if (session_status() == PHP_SESSION_NONE) {

    session_start();

}

?>

<div class="sidebar">

    <h3 class="text-center">

        SIGIVEM

    </h3>

    <hr>

    <a href="../dashboard/dashboard.php">

        🏠 Dashboard

    </a>

    <?php if ($_SESSION['rol'] == 1): ?>

        <a href="../usuarios/index.php">

            👤 Usuarios

        </a>

        <a href="../categorias/index.php">

            📂 Categorías

        </a>

        <a href="../reportes/index.php">

            📊 Reportes

        </a>

    <?php endif; ?>

    <a href="../productos/index.php">

        📦 Productos

    </a>

    <a href="../ventas/index.php">

        💰 Ventas

    </a>

    <a href="../ventas/historial.php">

        📄 Historial

    </a>

    <hr>

    <a href="../../cerrarSesion.php">

        🚪 Cerrar sesión

    </a>

</div>