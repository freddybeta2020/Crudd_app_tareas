<?php

require_once"database.php";

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  try { 
    $dsn = "mysql:host=localhost;dbname=tasks-app";   
    // Crear una instancia de PDO
    $pdo = new PDO($dsn, $user, $password);
    // Establecer el modo de error de PDO a excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM tasks WHERE id = :id";
    // Preparar la consulta
    $stmt = $pdo->prepare($query);
    // Asignar valores a los parámetros
    $stmt->bindParam(':id', $id,);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener los resultados
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $json = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
      );
      // Convertir a JSON
      $jsonstring = json_encode($json);
      echo $jsonstring;
    }
  } catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
  }
}



/*
include('database.php');

if(isset($_POST['id'])) {
$id = mysqli_real_escape_string($conection, $_POST['id']);

$query = "SELECT * FROM tasks WHERE id = $id";

$result = mysqli_query($conection, $query);
if(!$result) {
die('Query Failed'. mysqli_error($conection));
}

$json = array();
while($row = mysqli_fetch_array($result)) {
$json[] = array(
'name' => $row['name'],
'description' => $row['description'],
'id' => $row['id']
);
}
$jsonstring = json_encode($json[0]);
echo $jsonstring;
}

?>
*/