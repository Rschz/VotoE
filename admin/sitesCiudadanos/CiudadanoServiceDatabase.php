<?php

class CiudadanoServiceDatabase implements IServiceBase
{
    private $utilities;
    private $context;

    public function __construct($directory)
    {
        $this->utilities = new Utilities();
        $this->context = new VotacionContext($directory);
    }

    public function GetList()
    {
        $listadoCiudadanos = array();

        $stmt = $this->context->db->prepare("Select * from tb_ciudadano");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $listadoCiudadanos;
        } else {
            while ($row = $result->fetch_object()) {

                $ciudadano = new Ciudadano();

                $ciudadano->codigo = $row->DocIdentidad;
                $ciudadano->nombre = $row->Nombre;
                $ciudadano->apellido = $row->Apellido;
                $ciudadano->email = $row->Email;
                $ciudadano->status = $row->Estado;

                array_push($listadoCiudadanos, $ciudadano);
            }
        }

        $stmt->close();
        return $listadoCiudadanos;
    }




    public function GetByCodigo($codigo)
    {
        $ciudadano = new Ciudadano();
        $stmt = $this->context->db->prepare("Select * from tb_ciudadano where DocIdentidad= ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $ciudadano->codigo = $row->DocIdentidad;
                $ciudadano->nombre = $row->Nombre;
                $ciudadano->apellido = $row->Apellido;
                $ciudadano->email = $row->Email;
                $ciudadano->status = $row->Estado;
            }
        }

        $stmt->close();
        return $ciudadano;
    }

    public function Add($entity)
    {
        $stmt = $this->context->db->prepare("insert into tb_ciudadano (DocIdentidad,Nombre, Apellido, Email, Estado) values(?,?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $entity->codigo,$entity->nombre, $entity->apellido, $entity->email, $entity->status);
        $stmt->execute();
        $stmt->close();

    }

    public function Update($codigo, $entity)
    {

        $stmt = $this->context->db->prepare("update tb_ciudadano set Nombre = ?, Apellido = ?, Email = ?, Estado = ? where DocIdentidad = ?");
        $stmt->bind_param("sssii", $entity->nombre, $entity->apellido, $entity->email, $entity->status, $codigo);
        $stmt->execute();
        $stmt->close();

    }

    public function Delete($codigo)
    {
        $stmt = $this->context->db->prepare("delete from tb_ciudadano where DocIdentidad = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $stmt->close();

    }
}
