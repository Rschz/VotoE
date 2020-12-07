<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'candidato.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CandidatoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CandidatoServiceDatabase.php';


$layout = new Layout(true);
$service = new CandidatoServiceDatabase("../database");
$utilities = new Utilities();

if (isset($_GET['codigo'])) {



  $candidatoid = $_GET['codigo'];

  $element = $service->GetByCodigo($candidatoid);

  if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['partido']) && isset($_POST['puesto']) && isset($_FILES['profilePhoto'])) {

    $updateCandidato = new Candidato();

    $updateCandidato->InitializeData($candidatoid, $_POST['nombre'], $_POST['apellido'], $_POST['partido'], $_POST['puesto'], $status);

    $service->Update($candidatoid, $updateCandidato);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se edito candidato ID " . $element->codigo) or die("Error escribiendo en el archivo");
    fclose($logFile);

    header("Location: candidatos.php");
    exit();
  };
} else {

  header("Location: candidatos.php");
  exit();
}





?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edición de candidato ID <?php echo $element->codigo ?></h1>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Editar candidato
        </div>
        <div class="card-body">
          <form enctype="multipart/form-data" action="editar.php?codigo=<?php echo $element->codigo ?>" method="POST">
            <div class="">
              <div class="form-group">
                <label for="codigo">ID de Candidato</label>
                <input type="numfmt_create" class="form-control" value="<?php echo $element->codigo ?>" placeholder="<?php echo $candidatoid; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $element->nombre ?>" placeholder="Nombre de candidato" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" value="<?php echo $element->apellido ?>" placeholder="Apellido de candidato" name="apellido" required>
              </div>
              <div class="form-group">
                <label for="partido">Partido al que pertenece</label>
                <input type="number" class="form-control" id="partido" value="<?php echo $element->partido ?>" placeholder="Partido al que pertenece" name="partido" required>
              </div>
              <div class="form-group">
                <label for="puesto">Puesto al que aspira</label>
                <input type="number" class="form-control" id="puesto" value="<?php echo $element->puesto ?>" placeholder="Puesto al que aspira" name="puesto" required>
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

              <tr style="line-height: 300%;">
                <td style="width: 5%; height: inherit;">

                  <?php if ($element->profilePhoto == "" || $element->profilePhoto == null) : ?>
                    <img width="70%" src="<?php echo "../assets/img/default.png" ?>" alt="" srcset="">

                  <?php else : ?>
                    <img width="70%" src="<?php echo "../assets/img/candidatos/" . $element->profilePhoto; ?>">
                  <?php endif; ?>


                </td>

                <div class="form-group">
                  <label for="photo" class="float-left">Editar foto del candidato</label>
                  <input type="file" class="form-control-file" id="photo" name="profilePhoto">
                </div>
              </tr>

            </div>

            <button type="submit" class="btn btn-primary float-right">Guardar</button>&nbsp;&nbsp;
            <a href="candidatos.php" class="btn btn-secondary float-right" role="button" aria-pressed="true">Volver atras</a>

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