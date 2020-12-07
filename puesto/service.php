<?php

class PuestoService implements IPuesto
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function GetByCiudadano($idCidudadano, $idEleccion)
    {
        $puestos = array();
        $stmt = $this->Context->Db->prepare("SELECT * FROM puestoelectivo WHERE id NOT IN (SELECT puesto from votacion WHERE ciudadano = ? AND eleccion = ?)");
        $stmt->bind_param("ss",$idCidudadano, $idEleccion);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $puestos;
        } else {
            while ($row = $resul->fetch_object()) {
                $puestos[] = new Puesto($row->Id, $row->Nombre, $row->Descripcion, $row->Estado);
            }
            return $puestos;
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
