<?php

class Ciudadano
{

    public $codigo;
    public $nombre;
    public $apellido;
    public $email;
    public $status;

    private $utilities;

    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($codigo, $nombre, $apellido, $email, $status = 1)
    {
        $this->codigo = $codigo ;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->status = $status;
        
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }
}
