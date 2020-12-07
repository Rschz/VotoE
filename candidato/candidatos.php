<?php
require_once('../layout/Layout.php');
require_once('../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('IService.php');
require_once('service.php');
require_once('candidato.php');



$layout = new Layout();
$candidatoServ = new CandidatoService("../conexion");

$msgWarning = "";
$candidatos = "";

if (isset($_GET['puesto'])) {
  $candidatos = $candidatoServ->GetByPuesto($_GET['puesto']);
}

if (isset($_GET['puesto'])) {
  $candidatos = $candidatoServ->GetByPuesto($_GET['puesto']);
}





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

      <?php if (empty($candidatos)) : ?>
        <div class="text-center">
          <h5>No hay resultados</h5>
        </div>
      <?php else : ?>
        <form action="" method="post">
        <button type="submit" id="votar" name="votar" class="btn btn-primary btn-lg btn-block mb-5" disabled>Votar</button>
          <div class="candidatos row row-cols-1 row-cols-md-3">
          <div class="col mb-4">
                <input type="radio" name="candidato" id="candidato" value="">
              <div class="card">
                <img src="../assets/img/persona-incognita.jpg" class="card-img-top" alt="... FOTO PERFIL">
                <div class="card-body">
                  <h5 class="card-title">Ninguno</h5>
                  <h5 class="card-text">-</h5>
                </div>
                <a href="#" class="stretched-link" onclick="return false"></a>
              </div>
              </div>
            <?php foreach ($candidatos as $candidato) : ?>
              <div class="col mb-4">
                <input type="radio" name="candidato" id="" value="<?php echo $candidato->Id;?>">
              <div class="card">
                <img src="../<?php echo $candidato->FotoPerfil; ?>" class="card-img-top" alt="... FOTO PERFIL">
                <div class="card-body">
                  <h5 class="card-title"><?php echo "$candidato->Nombre $candidato->Apellido"; ?></h5>
                  <h5 class="card-text"><?php echo $candidato->Partido; ?></h5>
                </div>
                <a href="#" class="stretched-link" onclick="return false"></a>
              </div>
              </div>
            <?php endforeach; ?>
          </div>
        </form>
      <?php endif; ?>
    </div>

  </div>
</main>


<?php $layout->PrintBottomPage(); ?>