<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo App</title>
  <!-- BOOTSTRAP 4  -->
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
</head>

<body>



  <!-- NAVIGATION  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Tasks App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <form class="form-inline my-2 my-lg-0">
          <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
  </nav>
  <div class="d-flex justify-content-between">
    <!--Boton cerrar sesion-->
    <form action="logout.php" method="post">
      <button type="submit" name="logout" class="btn btn-info">Cerrar sesión</button>
    </form>

    <!--Boton Importar tareas-->
    <form action="exportar.php" method="post">
      <button type="submit" name="logout" class="btn btn-success">Importar Tareas</button>
    </form>
  </div>



  <!-- FORMULARIO PARA AGREGAR TAREAS -->
  <div class="container">
    <div class="row p-4">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <form id="task-form">
              <div class="form-group">
                <input type="text" id="name" placeholder="Task Name" class="form-control">
              </div>
              <div class="form-group">
                <textarea id="description" cols="30" rows="10" class="form-control" placeholder="Task Description"></textarea>
              </div>
              <input type="hidden" id="taskId">
              <button type="submit" class="btn btn-primary btn-block text-center">
                Guadar Tarea
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- TABLE  -->
      <div class="col-md-7">
        <div class="card my-4" id="task-result">
          <div class="card-body">
            <!-- SEARCH -->
            <ul id="container"></ul>
          </div>
        </div>

        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <td>Id</td>
              <td>Name</td>
              <td>Description</td>
            </tr>
          </thead>
          <tbody id="tasks"></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-4">
        <?php
        if (isset($_SESSION['message'])) {
          echo "<h4>" . $_SESSION['message'] . "</h4>";
          unset($_SESSION['message']);
        }
        ?>
        <div class="card-body">
          <form action="code.php" method="POST" enctype="multipart/form-data">
            <label for="import_file">
              <h4>Selecciona un archivo:</h4>
            </label>
            <input type="file" class="form-control" id="import_file" name="import_file">
            <button type="submit" name="save_excel_data" class="btn btn-info mt-3">Cargar Archivo</button>
          </form>
        </div>
      </div>
    </div>
  </div>





  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <!-- Frontend Logic -->
  <script src="app.js"></script>

</body>

</html>