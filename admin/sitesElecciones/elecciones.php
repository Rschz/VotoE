<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'eleccion.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'EleccionServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CsvFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'EleccionServiceDatabase.php';


$layout = new Layout(true);
$service = new EleccionServiceDatabase("../database");
$utilities = new Utilities();

$listadoElecciones = $service->GetList();

$json_filename = 'data/elecciones.json';
$csv_filename = 'data.csv';
// jsonToCSV($json_filename, $csv_filename);
$utilities->jsonToCSV($json_filename, $csv_filename);

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Elecciones</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
  <?php echo '<a style="float: right;" href="' . $csv_filename . '" target="_blank">Descarga todas las elecciones</a>' ?>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php if (empty($listadoElecciones)) : ?>

          <h3>No hay elecciones registradas, registra aqui: <a href="nuevaEleccion.php" class="btn btn-primary">nueva eleccion</a> </h3>

        <?php else : ?>

          <?php foreach ($listadoElecciones as $eleccin) : ?>

            <tr style="line-height: 300%;">
              <td><?php echo $eleccin->codigo ?></td>
              <td><?php echo $eleccin->nombre ?></td>
              <td><?php echo $eleccin->fecha ?></td>
              <td><?php echo $eleccin->status ?></td>
              <td><a href="editar.php?codigo=<?php echo $eleccin->codigo ?>" class="btn btn-outline-primary link">Editar</a></td>
              <?php echo "<td><a href='eliminar.php?codigo=$eleccin->codigo' onclick=\"return confirm('¿Está seguro que desea eliminar?');\" class='btn btn-outline-danger link'>Eliminar</a></td>"; ?>
            </tr>

          <?php endforeach; ?>

        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php $layout->printFooter(true); ?>