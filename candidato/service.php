<?php

class CandidatoService implements ICandidato
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function GetAll()
    {
        $puestos = array();
        $stmt = $this->Context->Db->prepare("SELECT * FROM `puestoelectivo`");
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
    public function GetByPuesto($idPuesto)
    {
        $candidatos = array();
        $stmt = $this->Context->Db->prepare("
        SELECT c.Id,c.Nombre,c.Apellido,p.Nombre AS Partido,c.Puesto,c.FotoPerfil,c.Estado
        FROM candidato c 
        INNER JOIN partido p ON c.Partido = p.Id 
        WHERE c.Puesto = ? AND c.Estado = 1
        ");
        $stmt->bind_param("s",$idPuesto);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $candidatos;
        } else {
            while ($row = $resul->fetch_object()) {
                $candidatos[] = new Candidato($row->Id, $row->Nombre, $row->Apellido,$row->Partido,$row->Puesto,$row->FotoPerfil, $row->Estado);
            }
            return $candidatos;
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
