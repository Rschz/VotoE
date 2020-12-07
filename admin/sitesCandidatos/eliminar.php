<?php

require_once '../helpers/utilities.php';
require_once 'candidato.php';
require_once '../service/iServiceBase.php';
require_once '../helpers/FileHandler/iFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'CandidatoServiceFile.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../database/VotacionContext.php';
require_once 'CandidatoServiceDatabase.php';


$service = new CandidatoServiceDatabase("../database");

$isContainCodigo = isset($_GET['codigo']);

if ($isContainCodigo) {

    $candidatoid = $_GET['codigo'];

    $service->Delete($candidatoid);

    $logFile = fopen("data/log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n" . date("d/m/Y H:i:s") . " Se elimino candidato ID " . $candidatoid) or die("Error escribiendo en el archivo");
    fclose($logFile);
}

header('Location: candidatos.php');
exit();
