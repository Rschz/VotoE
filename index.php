<?php
require_once('layout/Layout.php');
require_once('helpers/JsonHandler.php');
require_once('conexion/db_conexion.php');
require_once('ciudadano/IService.php');
require_once('ciudadano/service.php');
require_once('ciudadano/ciudadano.php');


$layout = new Layout();
$ciudadanoServ = new CiudadanoService("conexion");


if (isset($_POST['docId'])) {
    echo $ciudadanoServ->Exist($_POST['docId']) ? "SI" : "NO";
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