<?php

class Eleccion
{

    public $codigo;
    public $nombre;
    public $fecha;
    public $status;

    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($codigo, $nombre, $fecha, $status)
    {
        $this->codigo = $codigo ;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->status = $status;
        
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }
}
