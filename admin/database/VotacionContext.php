<?php 

class VotacionContext{

    public $db;
    private $fileHandler;

    function __construct($directory)
    {
        $fileHandler = new JsonFileHandler($directory, "configuration");
        $configuration = $fileHandler->ReadConfiguration();
        $this->db = new mysqli($configuration->server, $configuration->user, $configuration->password, $configuration->database);

        if($this->db->connect_error){
            exit('Error connecting to database');
        }
    }

}

?>