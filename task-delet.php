<?php

require_once "database.php";
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $dsn = "mysql:host=localhost;dbname=tasks-app";
        // Crear una instancia de PDO
        $pdo = new PDO($dsn, $user, $password);        
        // Establecer el modo de error de PDO a excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $query = "DELETE FROM tasks WHERE id = :id";        
        // Preparar la consulta
        $stmt = $pdo->prepare($query);        
        // Asignar valores a los parámetros
        $stmt->bindParam(':id', $id,);        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo 'Task Deleted Successfully';
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}




/*include('database.php');

if(isset($_POST['id'])){

   $id = $_POST['id'];

   $query = "DELETE FROM tasks WHERE id = $id";
   $result = mysqli_query($conection , $query);
    if(!$result){
        die('Query Falied');
    }
    echo 'Task Deleted Succesfully';

}
*/