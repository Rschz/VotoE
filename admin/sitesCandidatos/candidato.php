<?php

class Candidato
{

    public $codigo;
    public $nombre;
    public $apellido;
    public $partido;
    public $puesto;
    public $status;
    public $profilePhoto;

    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($codigo, $nombre, $apellido, $partido, $puesto, $status)
    {
        $this->codigo = $codigo ;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->partido = $partido;
        $this->puesto = $puesto;
        $this->status = $status;
        
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }
}
