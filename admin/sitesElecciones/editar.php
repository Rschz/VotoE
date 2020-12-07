<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'eleccion.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'EleccionServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'EleccionServiceDatabase.php';


$layout = new Layout(true);
$service = new EleccionServiceDatabase("../database");
$utilities = new Utilities();

if (isset($_GET['codigo'])) {



  $eleccionid = $_GET['codigo'];

  $element = $service->GetByCodigo($eleccionid);

  if (isset($_POST['nombre']) && isset($_POST['fecha'])) {

    $updateEleccion = new Eleccion();

    $updateEleccion->InitializeData($eleccionid, $_POST['nombre'], $_POST['fecha'], $status);

    $service->Update($eleccionid, $updateEleccion);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se edito eleccion ID " . $element->codigo) or die("Error escribiendo en el archivo");
    fclose($logFile);

    header("Location: elecciones.php");
    exit();
  };
} else {

  header("Location: elecciones.php");
  exit();
}





?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edición de eleccion ID <?php echo $element->codigo ?></h1>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Editar eleccion
        </div>
        <div class="card-body">
          <form enctype="multipart/form-data" action="editar.php?codigo=<?php echo $element->codigo ?>" method="POST">
            <div class="">
              <div class="form-group">
                <label for="codigo">ID de Eleccion</label>
                <input type="numfmt_create" class="form-control" value="<?php echo $element->codigo ?>" placeholder="<?php echo $eleccionid; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $element->nombre ?>" placeholder="Nombre de la eleccion" name="nombre" required>
              </div>

              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" value="<?php echo $element->fecha ?>" placeholder="Fecha de la eleccion" name="fecha" required>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="status" name="status" value="Activo" <?php if ($element->status == 'Activo') {
                                                                                                              echo 'checked';
                                                                                                            }
                                                                                                            ?>>
                  <label class="form-check-label" for="status">
                    ¿Activo?
                  </label>
                </div>
              </div>

            </div>

            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="elecciones.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>

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