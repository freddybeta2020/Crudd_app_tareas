<?php

require_once "database.php";
$search = $_POST['search'];
if (!empty($search)) {
  try {
    // $dsn = "mysql:host=localhost;dbname=tasks-app";    
    // // Crear una instancia de PDO
    // $pdo = new PDO($dsn, $user, $password);
    // // Establecer el modo de error de PDO a excepciones
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM tasks WHERE name LIKE :search";
    // Preparar la consulta
    $stmt = $pdo->prepare($query);
    // Asignar valores a los parámetros
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener los resultados
    $json = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $json[] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
      );
    }
    // Convertir a JSON
    $jsonstring = json_encode($json);
    echo $jsonstring;
  } catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
  }
}


/*
include('database.php');

$search = $_POST['search'];
if(!empty($search)) {
$query = "SELECT * FROM tasks WHERE name LIKE '%$search%' ";
$result = mysqli_query($conection, $query);

if(!$result) {
die('Query Error' . mysqli_error($conection));
}

$json = array();
while($row = mysqli_fetch_array($result)) {
$json[] = array(
'name' => $row['name'],
'description' => $row['description'],
'id' => $row['id']
);
}
$jsonstring = json_encode($json);
echo $jsonstring;
}

?>
*/