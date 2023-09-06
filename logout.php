<?php
session_start();

if (isset($_POST['logout'])) {

  
  
  // Destruir la sesión y redirigir al usuario a la página de inicio de sesión o a otra página de tu elección
  session_destroy();
  header("Location: login.php"); // Ajusta la URL de redirección según tus necesidades
  exit();

}
?>

