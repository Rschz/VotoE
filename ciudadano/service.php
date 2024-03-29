<?php

class CiudadanoService implements ICiudadano
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }


    public function IsActive($docId)
    {
        $stmt = $this->Context->Db->prepare("SELECT DocIdentidad from tb_ciudadano WHERE DocIdentidad = ? AND Estado = 1 LIMIT 1");
        $stmt->bind_param('s', $docId);
        $stmt->execute();
        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            $stmt->close();
            return false;
        } else {
            $stmt->close();
            return true;
        }
        
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
