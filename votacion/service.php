<?php

class VotacionService implements IVotacion
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function HaVotado($idEleccion,$docId)
    {
        $stmt = $this->Context->Db->prepare("SELECT * FROM `votacion` WHERE eleccion = ? AND ciudadano = ? LIMIT 1");
        $stmt->bind_param("ss",$idEleccion,$docId);
        $stmt->execute();
        $resul = $stmt->get_result();
       

        if ($resul->num_rows === 0) {
            return false;
        } else {
            return true;
        }
        $stmt->close();

    }
    public function GetById($id)
    {
    }
    public function Add($obj)
    {
        $stmt = $this->Context->Db->prepare("INSERT INTO `votacion` (`eleccion`, `ciudadano`, `candidato`, `puesto`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$obj->Eleccion,$obj->Ciudadano,$obj->Candidato,$obj->Puesto);
        $stmt->execute();
        $stmt->close();

    }
    public function Update($obj)
    {
    }
    public function Delete($id)
    {
    }
}
