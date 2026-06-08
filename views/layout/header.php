<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>SIGIVEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/estilos.css">

</head>

<body>

    <div class="wrapper">

        <?php require_once "sidebar.php"; ?>

        <div class="contenido">

            <nav class="navbar bg-white shadow-sm">

                <div class="container-fluid d-flex justify-content-end">

                    <div class="usuario-box">

                        <div class="usuario-icon">

                            👤

                        </div>

                        <div>

                            <div class="usuario-texto">

                                Bienvenido:

                                <strong>

                                    <?= $_SESSION['nombre'] ?>

                                </strong>

                            </div>

                            <div class="usuario-rol">

                                <?= ($_SESSION['rol'] == 1)
                                    ? "Administrador"
                                    : "Vendedor" ?>

                            </div>

                        </div>

                    </div>

                </div>

            </nav>

            <div class="container mt-3"></div>