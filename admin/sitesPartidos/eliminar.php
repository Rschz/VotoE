<?php

require_once '../helpers/utilities.php';
require_once 'partido.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'PartidoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'PartidoServiceDatabase.php';


$service = new PartidoServiceDatabase("../database");

$isContainCodigo = isset($_GET['codigo']);

if ($isContainCodigo) {

    $partidoid = $_GET['codigo'];

    $service->Delete($partidoid);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se elimino partido ID " . $partidoid) or die("Error escribiendo en el archivo");
    fclose($logFile);
}

header('Location: partidos.php');
exit();
