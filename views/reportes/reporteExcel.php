<?php

require "../../vendor/autoload.php";
require_once "../../models/Reporte.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();

$hoja = $excel->getActiveSheet();

$modelo = new Reporte();

$ventas = $modelo->ventas();

$hoja->setCellValue(
    'A1',
    'ID'
);

$hoja->setCellValue(
    'B1',
    'Usuario'
);

$hoja->setCellValue(
    'C1',
    'Fecha'
);

$hoja->setCellValue(
    'D1',
    'Total'
);

$fila = 2;

foreach ($ventas as $v) {

    $hoja->setCellValue(
        'A' . $fila,
        $v['id_venta']
    );

    $hoja->setCellValue(
        'B' . $fila,
        $v['usuario']
    );

    $hoja->setCellValue(
        'C' . $fila,
        $v['fecha']
    );

    $hoja->setCellValue(
        'D' . $fila,
        $v['total']
    );

    $fila++;

}

$writer = new Xlsx($excel);

header(
    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
    'Content-Disposition: attachment;filename="ventas.xlsx"'
);

$writer->save(
    'php://output'
);

exit;

?>