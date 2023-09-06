<?php

//Base de Datos conectada con conexio PDO

$user = "root";
$password = "";

try {
  $dsn = "mysql:host=localhost;dbname=tasks-app";
  $pdo = new PDO($dsn, $user, $password);
 

} catch (PDOException $e) {
  echo $e->getMessage();
} finally {
  $dsn = null;
}





