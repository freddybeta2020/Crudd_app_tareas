<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-type: application/json");
    $array_devolver = [];
    $email = strtolower($_POST['email']);

    // Comprobar si el usuario existe
    $buscar_user = $con->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if ($buscar_user->rowCount() == 1) {
        // Existe
        $array_devolver['error'] = "Este Email ya existe";
        $array_devolver['is_login'] = false;
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $nuevo_user = $con->prepare("INSERT INTO usuarios (email, password) VALUES (:email, :password)");
        $nuevo_user->bindParam(':email', $email, PDO::PARAM_STR);
        $nuevo_user->bindParam(':password', $password, PDO::PARAM_STR);
        $nuevo_user->execute();

        $user_id = $con->lastInsertId();
        $_SESSION['user_id'] = (int) $user_id;
        $array_devolver['redirect'] = 'http://localhost/task_app/login.php';
        $array_devolver['is_login'] = true;
        
        
    }

    echo json_encode($array_devolver);
} else {
    exit("No puedes ingresar");
}
?>
