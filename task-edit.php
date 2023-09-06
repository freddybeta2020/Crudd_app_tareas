<?php

require_once "database.php";

if (isset($_POST['id'])) {
    $task_name = $_POST['name'];
    $task_description = $_POST['description'];
    $id = $_POST['id'];
    try {
        $dsn = "mysql:host=localhost;dbname=tasks-app";
        // Crear una instancia de PDO
        $pdo = new PDO($dsn, $user, $password);        
        // Establecer el modo de error de PDO a excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $query = "UPDATE tasks SET name = :task_name, description = :task_description WHERE id = :id";        
        // Preparar la consulta
        $stmt = $pdo->prepare($query);        
        // Asignar valores a los parámetros
        $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
        $stmt->bindParam(':task_description', $task_description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo "Task Updated Successfully";
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}







 /* include('database.php');

if(isset($_POST['id'])) {
  $task_name = $_POST['name']; 
  $task_description = $_POST['description'];
  $id = $_POST['id'];
  $query = "UPDATE tasks SET name = '$task_name', description = '$task_description' WHERE id = '$id'";
  $result = mysqli_query($conection, $query);

  if (!$result) {
    die('Query Failed.');
  }
  echo "Task Update Successfully";  

}

?>*/