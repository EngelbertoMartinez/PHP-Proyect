<!DOCTYPE html>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <h2>Nuevo Usuario</h2>

        <form action="../../controllers/UsuarioController.php?accion=guardar" method="POST">

            <input name="nombre" placeholder="Nombre" class="form-control mb-2" required>

            <input name="usuario" placeholder="Usuario" class="form-control mb-2" required>

            <input name="correo" placeholder="Correo" class="form-control mb-2" required>

            <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>

            <select name="rol" class="form-control">

                <option value="1">

                    Administrador

                </option>

                <option value="2">

                    Vendedor

                </option>

            </select>

            <br>

            <button class="btn btn-primary">

                Guardar

            </button>

        </form>

    </div>

</body>

</html>