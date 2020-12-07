<?php
require_once 'layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'ciudadano.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CiudadanoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CsvFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CiudadanoServiceDatabase.php';


$layout = new Layout(true);
$service = new CiudadanoServiceDatabase("../database");
$utilities = new Utilities();

$listadoCiudadanos = $service->GetList();

$json_filename = 'data/ciudadanos.json';
$csv_filename = 'data.csv';
// jsonToCSV($json_filename, $csv_filename);
$utilities->jsonToCSV($json_filename, $csv_filename);

?>

<?php $layout->printHeader(true); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ciudadanos</h1>
  </div>

  <h2></h2>
  <div class="table-responsive">
  <?php echo '<a style="float: right;" href="' . $csv_filename . '" target="_blank">Descarga todos los ciudadanos</a>' ?>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Documento de id.</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>

        <?php if (empty($listadoCiudadanos)) : ?>

          <h3>No hay ciudadanos registrados, registra aqui: <a href="nuevoCiudadano.php" class="btn btn-primary">nuevo ciudadano</a> </h3>

        <?php else : ?>

          <?php foreach ($listadoCiudadanos as $ciudadan) : ?>

            <tr style="line-height: 300%;">
              <td><?php echo $ciudadan->codigo ?></td>
              <td><?php echo $ciudadan->nombre ?></td>
              <td><?php echo $ciudadan->apellido ?></td>
              <td><?php echo $ciudadan->email ?></td>
              <td><?php echo $ciudadan->status ?></td>
              <td><a href="editar.php?codigo=<?php echo $ciudadan->codigo ?>" class="btn btn-outline-primary link">Editar</a></td>
              <?php echo "<td><a href='eliminar.php?codigo=$ciudadan->codigo' onclick=\"return confirm('¿Está seguro que desea eliminar?');\" class='btn btn-outline-danger link'>Eliminar</a></td>"; ?>
            </tr>

          <?php endforeach; ?>

        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php $layout->printFooter(true); ?>