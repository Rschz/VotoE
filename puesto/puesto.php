<?php

class Puesto
{
    public $Id;
    public $Nombre;
    public $Descripcion;
    public $Estado;

    public function __construct($id,$nom,$des,$estado) {
        $this->Id = $id;
        $this->Nombre = $nom;
        $this->Descripcion = $des;
        $this->Estado = $estado;
    }

    
}


?>