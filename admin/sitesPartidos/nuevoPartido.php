<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'partido.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'PartidoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'PartidoServiceDatabase.php';


$layout = new Layout(true);
$service = new PartidoServiceDatabase("../database");
$utilities = new Utilities();


global $partidoid;

if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_FILES['profilePhoto'])) {

  $newPartido = new Partido();
  $status = !empty($_POST['status']) ? 1 : 0;

  $newPartido->InitializeData(0, $_POST['nombre'], $_POST['descripcion'], $status);

  $service->Add($newPartido);

  $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se creo nuevo partido") or die("Error escribiendo en el archivo");
  fclose($logFile);

  header("Location: partidos.php");
  exit();
};

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nuevo partido</h1>
  </div>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Crear nuevo partido
        </div>
        <div class="card-body">
          <form class="was-validated" enctype="multipart/form-data" action="nuevoPartido.php" method="POST">
            <div class="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del partido" name="nombre" required>
              </div>
              <div class="form-group">
                <p>Descripción:</p>
                <textarea type="text" class="form-control" name="descripcion" rows="4" cols="70" wrap="off"></textarea>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="Activo" checked>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="photo" class="float-left">Elegir logo del partido</label>
                <input type="file" class="form-control-file" id="photo" name="profilePhoto">
              </div>

            </div>

            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="partidos.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>


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