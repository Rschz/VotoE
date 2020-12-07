<?php
require_once 'layout/layout.php';

// $layout = New Layout(false);

session_start();

$_SESSION['estudiantes'] = isset($_SESSION['estudiantes']) ? $_SESSION['estudiantes'] : array();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Sistema de votacion</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

  <link href="assets/css/libreria/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php">Sistema de voto</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul id="navigation" class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="sitesCandidatos/candidatos.php">
                <span data-feather="file"></span>
                Candidatos 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sitesCiudadanos/ciudadanos.php">
                <span data-feather="file"></span>
                Ciudadanos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sitesElecciones/elecciones.php">
                <span data-feather="file"></span>
                Elecciones
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sitesPartidos/partidos.php">
                <span data-feather="file"></span>
                Partidos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sitesPuestoElectivo/puestos.php">
                <span data-feather="file"></span>
                Puestos electivos
              </a>
            </li>
          </ul>
        </div>
      </nav>


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Bienvenido(a) a tu sistema de voto</h1>
        </div>

        <h2></h2>
        <div class="table-responsive">
          <img src="assets\img\jce.jpg" class="img-fluid" alt="">
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="assets/js/libreria/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="assets/js/index.js"></script>
  <script>
    $(document).ready(function() {
      var selector = '.nav-item a';
      $(selector).on('click', function() {
        $(selector).removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>
</body>

</html>