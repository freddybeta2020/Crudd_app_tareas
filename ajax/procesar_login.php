
<?php
require_once "../config.php";

session_start();

    //Comprobar si existe una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-type: application/json");
    $array_devolver = [];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    // Comprobar si el usuario existe
    $buscar_user = $con->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if ($buscar_user->rowCount() == 1) {
        // Existe
        $user=$buscar_user->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $user['user_id'];
        $hash= (string) $user['password'];
        if(password_verify($password,$hash)){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] =  $user['email'];
            $array_devolver['redirect'] = 'http://localhost/task_app/index1.php';

        }else{
            $array_devolver['error']='Los datos no coinciden ingresa los datos correctos';    
        }
      
    } else {
        $array_devolver['error']="No tienes cuenta. <a href='http://localhost/task_app/registro.php'>Registrate</a>";
    }
    
    echo json_encode($array_devolver);
}else {
    exit("No puedes ingresar");
}

