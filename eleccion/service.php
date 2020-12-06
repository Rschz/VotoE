<?php

class EleccionService implements IEleccion
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }


    public function ActiveEleccion()
    {
        $stmt = $this->Context->Db->prepare("SELECT * FROM `eleccion` WHERE Estado = 1 LIMIT 1");
        $stmt->execute();
        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return false;
        } else {
            $row =  $resul->fetch_object();
            $eleccion = new Eleccion($row->Id,$row->Nombre,$row->FechaRealizacion,$row->Estado);
            return $eleccion;
        }
        $stmt->close();
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
