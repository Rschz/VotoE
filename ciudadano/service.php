<?php

class CiudadanoService implements ICiudadano
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }


    public function Exist($id)
    {
        $stmt = $this->Context->Db->prepare("SELECT DocIdentidad from ciudadano WHERE DocIdentidad = ? LIMIT 1");
        $stmt->bind_param('s', $id);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return false;
        } else {
            return true;
        }
        $stmt->close();
    }
    public function GetAll()
    {
    }
    public function GetById($id)
    {
    }
    public function Add($obj)
    {
    }
    public function Update($obj)
    {
    }
    public function Delete($id)
    {
    }
}
