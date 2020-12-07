<?php
require_once('layout/Layout.php');
require_once('helpers/JsonHandler.php');
require_once('conexion/db_conexion.php');
require_once('ciudadano/IService.php');
require_once('ciudadano/service.php');
require_once('ciudadano/ciudadano.php');
require_once('eleccion/IService.php');
require_once('eleccion/service.php');
require_once('eleccion/eleccion.php');
require_once('votacion/IService.php');
require_once('votacion/service.php');



$layout = new Layout();
$ciudadanoServ = new CiudadanoService("conexion");
$eleccionServ = new EleccionService("conexion");
$votacionServ = new VotacionService("conexion");

$eleccionActiva = $eleccionServ->ActiveEleccion();

$msgWarning = "";


if (isset($_POST['docId'])) {
    $votacionServ->HaVotado($eleccionActiva->Id, $_POST['docId']);
    if (!$eleccionActiva) {
        $msgWarning = "No hay proceso electorar en estos momentos.";
    } elseif ($votacionServ->HaVotado($eleccionActiva->Id, $_POST['docId'])) {
        $msgWarning = "Ya ha ejercido su derecho al voto.";
    } elseif (!$ciudadanoServ->IsActive($_POST['docId'])) {
        $msgWarning = "No se encuentra activo.";
    } else {
        $_SESSION['userId'] =$_POST['docId'];
        $_SESSION['eleccionId'] = $eleccionActiva->Id; 
        header("Location:puesto/puestos.php");
    }
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
            <?php if (!empty($msgWarning)): ?>
                <div class="alert alert-warning alert-dismissible fade show w-50 m-auto" role="alert">
                    <strong><?php echo $msgWarning;?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="docId">Número de identificación </label>
                    <input type="text" class="form-control w-50 mx-auto text-center" id="docId" name="docId" aria-describedby="docIdHelp" placeholder="01234567891">
                    <small id="docIdHelp" class="form-text text-muted">Digite su número de identidad sin guiones u otro separador.</small>
                </div>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>
        </div>
</main>


<?php $layout->PrintBottomPage(); ?>