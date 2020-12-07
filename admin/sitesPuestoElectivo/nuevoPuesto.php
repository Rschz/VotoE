<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'puesto.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'PuestoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'PuestoServiceDatabase.php';


$layout = new Layout(true);
$service = new PuestoServiceDatabase("../database");
$utilities = new Utilities();


global $puestoid;

if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {

  $newPuesto = new Puesto();
  $status = !empty($_POST['status']) ? 1 : 0;

  $newPuesto->InitializeData(0, $_POST['nombre'], $_POST['descripcion'], $status);

  $service->Add($newPuesto);

  $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se creo nuevo puesto") or die("Error escribiendo en el archivo");
  fclose($logFile);

  header("Location: puestos.php");
  exit();
};

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nuevo puesto</h1>
  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Crear nuevo puesto
        </div>
        <div class="card-body">
          <form class="was-validated" enctype="multipart/form-data" action="nuevoPuesto.php" method="POST">
            <div class="">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del puesto" name="nombre" required>
              </div>
              <div class="form-group">
                <p>Descripción:</p>
                <textarea class="form-control" name="descripcion" rows="4" cols="70" wrap="off"></textarea>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="Activo" checked>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="puestos.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>


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