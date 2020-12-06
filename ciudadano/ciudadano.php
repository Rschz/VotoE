<?php

class Ciudadano
{
    public $DocId;
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Estado;

    public function __construct($docId, $nom,$ape,$email,$estado) {
        $this->DocId = $docId;
        $this->Nombre = $nom;
        $this->Apellido = $ape;
        $this->Email = $email;
        $this->Estado = $estado;
    }
    
    
}

?>