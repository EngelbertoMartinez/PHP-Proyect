<?php

require_once "../models/Producto.php";

$modelo = new Producto();

$texto = $_GET['buscar'] ?? '';

$resultados =
    $modelo->buscar($texto);

foreach ($resultados as $p) {

    echo "

<tr>

<td>{$p['id_producto']}</td>

<td>{$p['nombre']}</td>

<td>{$p['descripcion']}</td>

<td>$ {$p['precio']}</td>

<td>{$p['stock']}</td>

<td>{$p['categoria']}</td>

<td>

<a
href='editar.php?id={$p['id_producto']}'
class='btn btn-warning btn-sm'
>

Editar

</a>

<a
href='../../controllers/ProductoController.php?accion=eliminar&id={$p['id_producto']}'
class='btn btn-danger btn-sm'
>

Eliminar

</a>

</td>

</tr>

";

}

?>