<!DOCTYPE html>
<html>

<head>

    <title>SIGIVEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <div class="card p-4">

            <h2>SIGIVEM</h2>

            <form action="../../controllers/LoginController.php" method="POST">

                <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-3" required>

                <input type="password" name="password" placeholder="Contraseña" class="form-control mb-3" required>

                <button class="btn btn-primary">
                    Entrar
                </button>

            </form>

        </div>

    </div>

</body>

</html>