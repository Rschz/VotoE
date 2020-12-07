<?php
session_start();
class Layout
{
    public $PAGE_TITLE;
    public $CURRENT_PAGE;
    public $DESC_PAGE;
    private $css = "";
    private $User;

    private $RELATIVE_ROOT_DIR;
    function __construct()
    {
        $this->PageConf();
        $this->User = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : "";
    }

    private function PageConf()
    {
        switch (basename($_SERVER["SCRIPT_NAME"])) {
            case "login.php":
                $this->RELATIVE_ROOT_DIR = "../";
                $this->CURRENT_PAGE = "login";
                $this->DESC_PAGE = "Ingrese sus credenciales para continuar";
                $this->PAGE_TITLE = "Inicio de sesión";
                $this->css = '<link rel="stylesheet" type="text/css" href="' . $this->RELATIVE_ROOT_DIR . 'assets/css/login.css">';
                break;
            case "puestos.php":
                $this->RELATIVE_ROOT_DIR = "../";
                $this->CURRENT_PAGE = "puesto";
                $this->DESC_PAGE = "Seleccione el puesto para elegir un candidato";
                $this->PAGE_TITLE = "Puestos Electorales";
                break;
            case "candidatos.php":
                $this->RELATIVE_ROOT_DIR = "../";
                $this->CURRENT_PAGE = "candidatos";
                $this->DESC_PAGE = "Elegir candidato de su preferencia";
                $this->PAGE_TITLE = "Cadidatos";
                break;
            default:
                $this->RELATIVE_ROOT_DIR = "";
                $this->CURRENT_PAGE = "index";
                $this->DESC_PAGE = "Sistema de voto electronico";
                $this->PAGE_TITLE = "Voto Electronico";
        }
    }

    public function PrintTopPage()
    {

        $topPage =
            <<<EOF
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$this->PAGE_TITLE}</title>
        
        <link rel="stylesheet" type="text/css" href="{$this->RELATIVE_ROOT_DIR}assets/css/bootstrap.min.css?v=3.4.2">
        {$this->css}
        </head>
        <body class="text-center">
        EOF;

        echo $topPage;
    }

    public function PrintHeader()
    {
        $header =
            <<<EOF
        <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="{$this->RELATIVE_ROOT_DIR}index.php">VotoE</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{$this->RELATIVE_ROOT_DIR}index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$this->RELATIVE_ROOT_DIR}publicacion/amigos.php">Amigos</a>
            </li>
          </ul>
          <div class="text-light"><b></b> <a href="usuario/logout.php" class="badge badge-dark">Iniciar Sesión</a></div>
        </div>
      </nav>
        </header>
EOF;


        if (empty($this->User)) {
            $header =
                <<<EOF
<header>
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  <a class="navbar-brand" href="{$this->RELATIVE_ROOT_DIR}index.php">VotoE</a>
  <div class="text-light ml-auto"><a href="usuario/logout.php" class="badge badge-dark">Iniciar Sesión</a></div>
</div>
</nav>
</header>
EOF;
        };



        echo $header;
    }


    public function PrintBottomPage()
    {

        $cDate = date("Y");

        $bottomPage =
            <<<EOF
            <footer class="footer bg-light">
                <div class="text-center py-3">
                <p class=" mb-3 text-muted">&copy SocialNET 2020-2021</p>
                </div>
            </footer>
            <script src="{$this->RELATIVE_ROOT_DIR}assets/js/jquery-3.5.1.min.js"></script>
            <script src="{$this->RELATIVE_ROOT_DIR}assets/js/bootstrap.min.js"></script>
            <script src="{$this->RELATIVE_ROOT_DIR}assets/js/main.js"></script>
        </body>
    </html>
    EOF;

        echo $bottomPage;
    }
}
