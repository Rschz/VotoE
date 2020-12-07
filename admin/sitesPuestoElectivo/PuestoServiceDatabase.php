<?php

class PuestoServiceDatabase implements IServiceBase
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
        $listadoPuestos = array();

        $stmt = $this->context->db->prepare("Select * from puestoelectivo");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $listadoPuestos;
        } else {
            while ($row = $result->fetch_object()) {

                $puesto = new Puesto();

                $puesto->codigo = $row->Id;
                $puesto->nombre = $row->Nombre;
                $puesto->descripcion = $row->Descripcion;
                $puesto->status = $row->Estado;

                array_push($listadoPuestos, $puesto);
            }
        }

        $stmt->close();
        return $listadoPuestos;
    }




    public function GetByCodigo($codigo)
    {
        $puesto = new Puesto();
        $stmt = $this->context->db->prepare("Select * from puestoelectivo where Id= ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $puesto->codigo = $row->Id;
                $puesto->nombre = $row->Nombre;
                $puesto->descripcion = $row->Descripcion;
                $puesto->status = $row->Estado;
            }
        }

        $stmt->close();
        return $puesto;
    }

    public function Add($entity)
    {
        $stmt = $this->context->db->prepare("insert into puestoelectivo (Nombre, Descripcion, Estado) values(?, ?, ?)");
        $stmt->bind_param("ssi", $entity->nombre, $entity->descripcion, $entity->status);
        $stmt->execute();
        $stmt->close();

    }

    public function Update($codigo, $entity)
    {

        $stmt = $this->context->db->prepare("update puestoelectivo set Nombre = ?, Descripcion = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssii", $entity->nombre, $entity->descripcion, $entity->status, $codigo);
        $stmt->execute();
        $stmt->close();

    }

    public function Delete($codigo)
    {
        $stmt = $this->context->db->prepare("delete from puestoelectivo where Id = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $stmt->close();

    }
}
