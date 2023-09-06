<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$user = "root";
$password = "";

try {
  $dsn = "mysql:host=localhost;dbname=leerdatos";
  $pdo1 = new PDO($dsn, $user, $password);
 

} catch (PDOException $e) {
  echo $e->getMessage();
} finally {
  $dsn = null;
}

$nombreArchivo = 'listaclientes.xlsx';
$doc = IOFactory::load($nombreArchivo);
$totalHojas = $doc->getSheetCount();


    $hojaActual = $doc->getSheet(0);
    $numeroFilas = $hojaActual->getHighestDataRow();
    $letra = $hojaActual->getHighestColumn();
    $numeroLetra = Coordinate::columnIndexFromString($letra);

    for($indiceFila = 1; $indiceFila<=$numeroFilas;$indiceFila++){
        
            $valorA =  $hojaActual->getCellByColumnAndRow(1,$indiceFila);
            $valorB =  $hojaActual->getCellByColumnAndRow(2,$indiceFila); 
            $valorC =  $hojaActual->getCellByColumnAndRow(3,$indiceFila); 
            $valorD =  $hojaActual->getCellByColumnAndRow(4,$indiceFila); 
            $valorE =  $hojaActual->getCellByColumnAndRow(5,$indiceFila); 
            $valorF =  $hojaActual->getCellByColumnAndRow(6,$indiceFila);  
            $valorG =  $hojaActual->getCellByColumnAndRow(7,$indiceFila); 
            $valorH =  $hojaActual->getCellByColumnAndRow(8,$indiceFila); 
            $valorI =  $hojaActual->getCellByColumnAndRow(9,$indiceFila); 
            $sql = "INSERT INTO clientes (user_id,nombre,fecha_nacimiento,direccion,localidad,telefono,email,fecha,grupoc)VALUES
            ('$valorA','$valorB','$valorC','$valorD','$valorE','$valorF','$valorG','$valorH','$valorI')";
            $pdo1->query($sql);
           
        }
      echo "Carga completa";
    
        


