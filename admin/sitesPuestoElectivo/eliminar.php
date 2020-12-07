<?php

require_once '../helpers/utilities.php';
require_once 'puesto.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'PuestoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'PuestoServiceDatabase.php';


$service = new PuestoServiceDatabase("../database");

$isContainCodigo = isset($_GET['codigo']);

if ($isContainCodigo) {

    $puestoid = $_GET['codigo'];

    $service->Delete($puestoid);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se elimino puesto ID " . $puestoid) or die("Error escribiendo en el archivo");
    fclose($logFile);
}

header('Location: puestos.php');
exit();
