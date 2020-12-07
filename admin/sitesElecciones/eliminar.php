<?php

require_once '../helpers/utilities.php';
require_once 'eleccion.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'EleccionServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'EleccionServiceDatabase.php';


$service = new EleccionServiceDatabase("../database");

$isContainCodigo = isset($_GET['codigo']);

if ($isContainCodigo) {

    $eleccionid = $_GET['codigo'];

    $service->Delete($eleccionid);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se elimino eleccion ID " . $eleccionid) or die("Error escribiendo en el archivo");
    fclose($logFile);
}

header('Location: elecciones.php');
exit();
