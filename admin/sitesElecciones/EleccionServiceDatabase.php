<?php

class EleccionServiceDatabase implements IServiceBase
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
        $listadoElecciones = array();

        $stmt = $this->context->db->prepare("Select * from eleccion");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $listadoElecciones;
        } else {
            while ($row = $result->fetch_object()) {

                $eleccion = new Eleccion();

                $eleccion->codigo = $row->Id;
                $eleccion->nombre = $row->Nombre;
                $eleccion->fecha = $row->FechaRealizacion;
                $eleccion->status = $row->Estado;

                array_push($listadoElecciones, $eleccion);
            }
        }

        $stmt->close();
        return $listadoElecciones;
    }




    public function GetByCodigo($codigo)
    {
        $eleccion = new Eleccion();
        $stmt = $this->context->db->prepare("Select * from eleccion where Id= ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $eleccion->codigo = $row->Id;
                $eleccion->nombre = $row->Nombre;
                $eleccion->fecha = $row->FechaRealizacion;
                $eleccion->status = $row->Estado;
            }
        }

        $stmt->close();
        return $eleccion;
    }

    public function Add($entity)
    {
        $stmt = $this->context->db->prepare("insert into eleccion (Nombre, FechaRealizacion, Estado) values(?, ?, ?)");
        $stmt->bind_param("ssb", $entity->nombre, $entity->fecha, $entity->status);
        $stmt->execute();
        $stmt->close();

    }

    public function Update($codigo, $entity)
    {

        $stmt = $this->context->db->prepare("update eleccion set Nombre = ?, FechaRealizacion = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssbi", $entity->nombre, $entity->fecha, $entity->status, $codigo);
        $stmt->execute();
        $stmt->close();
    }

    public function Delete($codigo)
    {
        $stmt = $this->context->db->prepare("delete from eleccion where Id = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $stmt->close();

    }
}
