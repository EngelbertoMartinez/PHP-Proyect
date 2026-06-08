<?php

require "../../vendor/autoload.php";
require_once "../../models/Reporte.php";

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont(
    'Arial',
    'B',
    14
);

$pdf->Cell(
    190,
    10,
    'SIGIVEM - Reporte de ventas',
    0,
    1,
    'C'
);

$pdf->Ln(10);

$modelo = new Reporte();

$ventas = $modelo->ventas();

$pdf->SetFont(
    'Arial',
    'B',
    10
);

$pdf->Cell(20, 10, "ID", 1);
$pdf->Cell(40, 10, "Usuario", 1);
$pdf->Cell(40, 10, "Fecha", 1);
$pdf->Cell(40, 10, "Total", 1);

$pdf->Ln();

$pdf->SetFont(
    'Arial',
    '',
    10
);

foreach ($ventas as $v) {

    $pdf->Cell(
        20,
        10,
        $v['id_venta'],
        1
    );

    $pdf->Cell(
        40,
        10,
        $v['usuario'],
        1
    );

    $pdf->Cell(
        40,
        10,
        $v['fecha'],
        1
    );

    $pdf->Cell(
        40,
        10,
        "$" . $v['total'],
        1
    );

    $pdf->Ln();

}

$pdf->Output();

?>