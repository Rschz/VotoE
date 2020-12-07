<?php

require_once '../helpers/utilities.php';
require_once 'ciudadano.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CiudadanoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CiudadanoServiceDatabase.php';


$service = new CiudadanoServiceDatabase("../database");

$isContainCodigo = isset($_GET['codigo']);

if ($isContainCodigo) {

    $ciudadanoid = $_GET['codigo'];

    $service->Delete($ciudadanoid);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se elimino ciudadano ID " . $ciudadanoid) or die("Error escribiendo en el archivo");
    fclose($logFile);
}

header('Location: ciudadanos.php');
exit();
