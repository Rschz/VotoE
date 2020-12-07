<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'puesto.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'PuestoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CsvFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'PuestoServiceDatabase.php';


$layout = new Layout(true);
$service = new PuestoServiceDatabase("../database");
$utilities = new Utilities();

$listadoPuestos = $service->GetList();

$json_filename = 'data/puestos.json';
$csv_filename = 'data.csv';
// jsonToCSV($json_filename, $csv_filename);
$utilities->jsonToCSV($json_filename, $csv_filename);

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Puestos</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
  <?php echo '<a style="float: right;" href="' . $csv_filename . '" target="_blank">Descarga todos los puestos</a>' ?>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php if (empty($listadoPuestos)) : ?>

          <h3>No hay puestos registrados, registra aqui: <a href="nuevoPuesto.php" class="btn btn-primary">nuevo puesto</a> </h3>

        <?php else : ?>

          <?php foreach ($listadoPuestos as $puest) : ?>

            <tr style="line-height: 300%;">
              <td><?php echo $puest->codigo ?></td>
              <td><?php echo $puest->nombre ?></td>
              <td><?php echo $puest->descripcion ?></td>
              <td><?php echo $puest->status ?></td>
              <td><a href="editar.php?codigo=<?php echo $puest->codigo ?>" class="btn btn-outline-primary link">Editar</a></td>
              <?php echo "<td><a href='eliminar.php?codigo=$puest->codigo' onclick=\"return confirm('¿Está seguro que desea eliminar?');\" class='btn btn-outline-danger link'>Eliminar</a></td>"; ?>
            </tr>

          <?php endforeach; ?>

        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php $layout->printFooter(true); ?>