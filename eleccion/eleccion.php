<?php

class Eleccion
{
    public $Id;
    public $Nombre;
    public $Fecha;
    public $Estado;

    public function __construct($id, $nom,$fecha,$estado) {
        $this->Id=$id;
        $this->Nombre = $nom;
        $this->Fecha = $fecha;
        $this->Estado = $estado;
    }
    
    
}

?>