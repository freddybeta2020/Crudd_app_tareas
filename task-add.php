<?php
require_once "database.php";



# Limpiar cadenas de texto para evitar inyecciones SQL #
function limpiar_cadena($cadena){
  $cadena=trim($cadena);
  $cadena=stripslashes($cadena);
  $cadena=str_ireplace("<script>", "", $cadena);
  $cadena=str_ireplace("</script>", "", $cadena);
  $cadena=str_ireplace("<script src", "", $cadena);
  $cadena=str_ireplace("<script type=", "", $cadena);
  $cadena=str_ireplace("SELECT * FROM", "", $cadena);
  $cadena=str_ireplace("DELETE FROM", "", $cadena);
  $cadena=str_ireplace("INSERT INTO", "", $cadena);
  $cadena=str_ireplace("DROP TABLE", "", $cadena);
  $cadena=str_ireplace("DROP DATABASE", "", $cadena);
  $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
  $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
  $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
  $cadena=str_ireplace("<?php", "", $cadena);
  $cadena=str_ireplace("?>", "", $cadena);
  $cadena=str_ireplace("--", "", $cadena);
  $cadena=str_ireplace("^", "", $cadena);
  $cadena=str_ireplace("<", "", $cadena);
  $cadena=str_ireplace("[", "", $cadena);
  $cadena=str_ireplace("]", "", $cadena);
  $cadena=str_ireplace("==", "", $cadena);
  $cadena=str_ireplace(";", "", $cadena);
  $cadena=str_ireplace("::", "", $cadena);
  $cadena=trim($cadena);
  $cadena=stripslashes($cadena);
  return $cadena;
}


$task_name = $_POST['name'];
$task_description = $_POST['description'];

$task_name = limpiar_cadena($task_name); // Limpiar $task_name y guardar el resultado limpio
$task_description = limpiar_cadena($task_description); // Limpiar $task_description y guardar el resultado limpio

$consult = $pdo->prepare("INSERT INTO tasks(name, description)VALUES(:name,:description)"); 

$consult->bindParam(':name',$task_name);
$consult->bindParam(':description',$task_description);

if ($consult->execute()) {
   echo "Los datos se guardaron de forma correcta";
}else{
    echo "No se guardaron los archivos";
};



