<?php
class Votacion
{
    public $Id;
    public $Eleccion;
    public $Ciudadano;
    public $Candidato;
    public $Puesto;
    
    
    public function __construct($id,$ele,$ciu,$can,$pue) {
        $this->Id = $id;
        $this->Eleccion = $ele;
        $this->Ciudadano = $ciu;
        $this->Candidato = $can;
        $this->Puesto = $pue;
    }
}



?>