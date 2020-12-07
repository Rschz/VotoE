<?php
require_once('../layout/Layout.php');
require_once('../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('IService.php');
require_once('service.php');
require_once('puesto.php');



$layout = new Layout();
$puestoServ = new PuestoService("../conexion");

$puestos = $puestoServ->GetByCiudadano($_SESSION['userId'],$_SESSION['eleccionId']);

$msgWarning = "";



$layout->PrintTopPage();
$layout->PrintHeader();

?>
<main role="main">
  <section class="jumbotron text-center mb-0">
    <div class="container">
      <h1 class="display-4"><?= $layout->PAGE_TITLE; ?></h1>
      <p class="lead"><?= $layout->DESC_PAGE; ?></p>
    </div>
  </section>
  <div class="py-5 bg-light vh-100">

  <div class="container">

    <?php if (empty($puestos)) : ?>
      <?php header("Location:../"); ?>
    <?php else : ?>
      <div class="p-2">
        <?php foreach ($puestos as $puesto) : ?>
          <a href="../candidato/candidatos.php?puesto=<?php echo $puesto->Id;?>" class="btn btn-outline-dark w-100">
            <div>
              <h3 class="mb-1 text-uppercase"><?php echo $puesto->Nombre; ?></h3>
            </div>
            <p class="mb-1"><?php echo $puesto->Descripcion ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  </div>
</main>


<?php $layout->PrintBottomPage(); ?>