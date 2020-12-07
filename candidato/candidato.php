<?php

class Candidato
{
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Partido;
    public $Puesto;
    public $FotoPerfil;
    public $Estado;

    public function __construct($id,$nom,$ape,$part,$pues,$foto,$estado) {
        $this->Id = $id;
        $this->Nombre = $nom;
        $this->Apellido = $ape;
        $this->Partido = $part;
        $this->Puesto = $pues;
        $this->FotoPerfil = $foto;
        $this->Estado = $estado;
    }

    
}


?>