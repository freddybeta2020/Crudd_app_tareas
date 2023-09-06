<?php
require_once "clases/db.php";
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: index1.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<?php include_once 'header.php'; ?>

<body class="bg-light">
    <div class="container">
        <div class="row d-flex justify-content-around mt-5">
            <div class="card col-md-6 col-md-offset-6 border border-sucess" >
                <article class="card-body">
                    <h2 class="card-title mb-4 mt-1 text-center">Registro</h2>
                    <form action="POST" class="form_registro">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="********">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Resgistrarse</button>
                        </div>
                    </form>
                    <div id="msg_error" class="alert alert-danger" role="alert" style="display:none;">Error</div>
                </article>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>