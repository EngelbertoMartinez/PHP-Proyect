<?php

require_once "../../models/Categoria.php";

$modelo = new Categoria();

$categoria =
    $modelo->obtenerPorId(
        $_GET['id']
    );

?>

<?php

session_start();

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>

            Editar categoría

        </h2>

        <a href="index.php" class="btn btn-secondary">

            ← Volver

        </a>

    </div>

    <form action="../../controllers/CategoriaController.php?accion=actualizar" method="POST">

        <input type="hidden" name="id" value="<?= $categoria['id_categoria'] ?>">

        <label>Nombre</label>

        <input class="form-control mb-3" name="nombre" value="<?= $categoria['nombre'] ?>" required>

        <button class="btn btn-primary">

            Actualizar

        </button>

    </form>

</div>

<?php

require_once "../layout/footer.php";

?>