<?php

session_start();

require_once "../layout/header.php";

?>

<div class="container mt-4">

    <h2>Reportes</h2>

    <a href="reportePDF.php" class="btn btn-danger">

        Exportar PDF

    </a>

</div>

<?php

require_once "../layout/footer.php";

?>