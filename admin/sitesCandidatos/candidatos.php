<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'candidato.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CandidatoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CsvFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CandidatoServiceDatabase.php';


$layout = new Layout(true);
$service = new CandidatoServiceDatabase("../database");
$utilities = new Utilities();

$listadoCandidatos = $service->GetList();

$json_filename = 'data/candidatos.json';
$csv_filename = 'data.csv';
// jsonToCSV($json_filename, $csv_filename);
$utilities->jsonToCSV($json_filename, $csv_filename);

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Candidatos</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
    <?php echo '<a style="float: right;" href="' . $csv_filename . '" target="_blank">Descarga todos los candidatos</a>' ?>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Partido</th>
          <th>Puesto</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php if (empty($listadoCandidatos)) : ?>

          <h3>No hay candidatos registrados, registra aqui: <a href="nuevoCandidato.php" class="btn btn-primary">nuevo candidato</a> </h3>

        <?php else : ?>

          <?php foreach ($listadoCandidatos as $candidats) : ?>

            <tr style="line-height: 300%;">
              <td style="width: 5%; height: inherit;">

                <?php if ($candidats->profilePhoto == "" || $candidats->profilePhoto == null) : ?>
                  <img width="70%" src="<?php echo "../assets/img/default.png" ?>" alt="" srcset="">

                <?php else : ?>
                  <img width="70%" src="<?php echo "../assets/img/candidatos/" . $candidats->profilePhoto; ?>" alt="" srcset="">
                <?php endif; ?>


              </td>
              <td><?php echo $candidats->codigo ?></td>
              <td><?php echo $candidats->nombre ?></td>
              <td><?php echo $candidats->apellido ?></td>
              <td><?php echo $candidats->partido ?></td>
              <td><?php echo $candidats->puesto ?></td>
              <td><?php echo $candidats->status ?></td>
              <td><a href="editar.php?codigo=<?php echo $candidats->codigo ?>" class="btn btn-outline-primary link">Editar</a></td>
              <?php echo "<td><a href='eliminar.php?codigo=$candidats->codigo' onclick=\"return confirm('¿Está seguro que desea eliminar?');\" class='btn btn-outline-danger link'>Eliminar</a></td>"; ?>
            </tr>

          <?php endforeach; ?>

        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php $layout->printFooter(true); ?>