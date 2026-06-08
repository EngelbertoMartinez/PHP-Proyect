<?php

require_once "../../models/Usuario.php";

$modelo = new Usuario();

$usuario =
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

            Editar usuario

        </h2>

        <a href="index.php" class="btn btn-secondary">

            ← Volver

        </a>

    </div>

    <form action="../../controllers/UsuarioController.php?accion=actualizar" method="POST">

        <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">

        <label>Nombre</label>

        <input class="form-control mb-2" name="nombre" value="<?= $usuario['nombre'] ?>" required>

        <label>Usuario</label>

        <input class="form-control mb-2" name="usuario" value="<?= $usuario['usuario'] ?>" required>

        <label>Correo</label>

        <input class="form-control mb-2" name="correo" value="<?= $usuario['correo'] ?>" required>

        <label>Nueva contraseña (opcional)</label>

        <input type="password" class="form-control mb-2" name="password">

        <label>Rol</label>

        <select class="form-control mb-3" name="rol">

            <option value="1" <?= $usuario['id_rol'] == 1 ? "selected" : "" ?>>

                Administrador

            </option>

            <option value="2" <?= $usuario['id_rol'] == 2 ? "selected" : "" ?>>

                Vendedor

            </option>

        </select>

        <button class="btn btn-primary">

            Actualizar

        </button>

    </form>

</div>

<?php

require_once "../layout/footer.php";

?>