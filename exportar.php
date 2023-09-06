<?php
//llamamos las librerias e instanciamos la conexion a la base de datos
require './vendor/autoload.php';
require_once 'database.php';
//
use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};
use PhpOffice\PhpSpreadsheet\Writer\Xls;

//Realizamos la consulta SQl,intanciamos la clase spreadsheet, se crea y se le asigna nombre a la tabla
$sql = "SELECT name, description FROM tasks ";
$resultado = $pdo->query($sql);
$excel = new  Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("Tareas");
//le damos nombre a los campos que vamos a usar
$hojaActiva->setCellValue('A1','name');
$hojaActiva->setCellValue('B1','description');
$fila = 2;
//recorremos la tabla para asignar los valores para cada campo
while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
  $hojaActiva->setCellValue('A'.$fila, $row['name']);
  $hojaActiva->setCellValue('B'.$fila, $row['description']); 
  $fila++; 
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Tareas.xls"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;



