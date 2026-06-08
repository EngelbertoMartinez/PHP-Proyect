<!DOCTYPE html>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <h2>Nueva Categoría</h2>

        <form action="../../controllers/CategoriaController.php?accion=guardar" method="POST">

            <input name="nombre" class="form-control mb-3" placeholder="Nombre categoría" required>

            <button class="btn btn-primary">

                Guardar

            </button>

        </form>

    </div>

</body>

</html>