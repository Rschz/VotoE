<?php

class Partido
{

    public $codigo;
    public $nombre;
    public $status;
    public $descripcion;
    public $profilePhoto;

    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($codigo, $nombre, $descripcion, $status)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->status = $status;
        
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }
}
