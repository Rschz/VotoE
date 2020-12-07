<?php

class PartidoServiceDatabase implements IServiceBase
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
        $listadoPartidos = array();

        $stmt = $this->context->db->prepare("Select * from partido");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $listadoPartidos;
        } else {
            while ($row = $result->fetch_object()) {

                $partido = new Partido();

                $partido->codigo = $row->Id;
                $partido->nombre = $row->Nombre;
                $partido->descripcion = $row->Descripcion;
                $partido->profilePhoto = $row->LogoPartido;
                $partido->status = $row->Estado;

                array_push($listadoPartidos, $partido);
            }
        }

        $stmt->close();
        return $listadoPartidos;
    }




    public function GetByCodigo($codigo)
    {
        $partido = new Partido();
        $stmt = $this->context->db->prepare("Select * from partido where Id= ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $partido->codigo = $row->Id;
                $partido->nombre = $row->Nombre;
                $partido->descripcion = $row->Descripcion;
                $partido->profilePhoto = $row->LogoPartido;
                $partido->status = $row->Estado;
            }
        }

        $stmt->close();
        return $partido;
    }

    public function Add($entity)
    {
        $stmt = $this->context->db->prepare("insert into partido (Nombre, Descripcion, Estado) values(?, ?, ?)");
        $stmt->bind_param("ssi", $entity->nombre, $entity->descripcion, $entity->status);
        $stmt->execute();
        $stmt->close();

        $partidoid = $this->context->db->insert_id;


        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = "";
            } else {
                $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $partidoid . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/partidos/', $name, $tmpname, $type, $size);
                if ($success) {
                    $stmt = $this->context->db->prepare("update partido set LogoPartido = ? where Id = ?");
                    $stmt->bind_param("si", $name, $partidoid);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);

        $stmt = $this->context->db->prepare("update partido set Nombre = ?, Descripcion = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssii", $entity->nombre, $entity->descripcion, $entity->status, $codigo);
        $stmt->execute();
        $stmt->close();


        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = $element->profilePhoto;
            } else {
                $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $codigo . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/partidos/', $name, $tmpname, $type, $size);
                if ($success) {
                    $stmt = $this->context->db->prepare("update partido set LogoPartido = ? where Id = ?");
                    $stmt->bind_param("si", $name, $codigo);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    public function Delete($codigo)
    {
        $stmt = $this->context->db->prepare("delete from partido where Id = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $stmt->close();

    }
}
