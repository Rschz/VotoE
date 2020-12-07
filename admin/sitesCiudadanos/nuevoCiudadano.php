<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'ciudadano.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CiudadanoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CiudadanoServiceDatabase.php';


$layout = new Layout(true);
$service = new CiudadanoServiceDatabase("../database");
$utilities = new Utilities();


global $ciudadanoid;

if (isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {

  $newCiudadano = new Ciudadano();
  $status = !empty($_POST['status']) ? 1 : 0;

  $newCiudadano->InitializeData($_POST['codigo'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $status);

  $service->Add($newCiudadano);

  $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se creo nueva ciudadano") or die("Error escribiendo en el archivo");
  fclose($logFile);

  header("Location: ciudadanos.php");
  exit();
};

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nuevo ciudadano</h1>
  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Crear nuevo ciudadano
        </div>
        <div class="card-body">
          <form class="was-validated" enctype="multipart/form-data" action="nuevoCiudadano.php" method="POST">
            <div class="">
              <div class="form-group">
                <label for="codigo">Documento de identidad</label>
                <input type="text" class="form-control" placeholder="Documento de identidad del ciudadano" name="codigo" id="codigo" required>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del ciudadano" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="Apellido del ciudadano" name="apellido" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email del ciudadano" name="email" required>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="activo" checked>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>

            </div>

            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="ciudadanos.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>


            <?php

            ?>


          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
  </div>
</main>

<?php $layout->printFooter(true); ?>