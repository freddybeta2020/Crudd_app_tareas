<?php
session_start();
//Para cargar archivos excel
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
//Reliza la conexion a la base de datos por medio de PDO
$host = 'localhost';
$dbname = 'tasks-app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

//Se verifica el envio de la informacion por medio del metodo POST 
//Se crea un arreglo con las extensiones de archivo permitidas
if (isset($_POST['save_excel_data'])) {
    $filename = $_FILES['import_file']['name'];
    $allowed_ext = ['xls', 'csv', 'xlsx', 'ods'];
    //Se extrae la extension del archivo recibido
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
    //Identifica la extension del archivo recibido y lo compara con las extensiones admitidas
    if (in_array($file_ext, $allowed_ext)) {
        $inputFileName = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        // Obtenemos el número de filas en la hoja de cálculo
        $numRows = $spreadsheet->getActiveSheet()->getHighestRow();

        // Establecemos el rango de celdas para obtener los datos desde la fila 2 hasta la última fila
        $range = 'A2:B' . $numRows;
        $data = $spreadsheet->getActiveSheet()->rangeToArray($range);

        /**Hacemos una busqueda de valores en la hoja de excel y se insertan a la base de datos **/
        foreach ($data as $row) {
            $name = $row['0'];
            $description = $row['1'];

            $query = "INSERT INTO tasks (`name`, `description`) VALUES (?, ?)";
            $statement = $pdo->prepare($query);
            $statement->execute([$name, $description]);
            $msg = true;
        }

        if (isset($msg)) {
            $_SESSION['message'] = "Archivo importado correctamente";
            header('Location: index1.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Archivo no importado";
            header('Location: index1.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Archivo no válido";
        header('Location: index1.php');
        exit(0);
    }
}











   