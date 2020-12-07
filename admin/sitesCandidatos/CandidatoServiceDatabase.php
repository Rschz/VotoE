<?php

class CandidatoServiceDatabase implements IServiceBase
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
        $listadoCandidatos = array();

        $stmt = $this->context->db->prepare("Select * from candidato");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $listadoCandidatos;
        } else {
            while ($row = $result->fetch_object()) {

                $candidato = new Candidato();

                $candidato->codigo = $row->Id;
                $candidato->nombre = $row->Nombre;
                $candidato->apellido = $row->Apellido;
                $candidato->partido = $row->Partido;
                $candidato->puesto = $row->Puesto;
                $candidato->profilePhoto = $row->FotoPerfil;
                $candidato->status = $row->Estado;

                array_push($listadoCandidatos, $candidato);
            }
        }

        $stmt->close();
        return $listadoCandidatos;
    }




    public function GetByCodigo($codigo)
    {
        $candidato = new Candidato();
        $stmt = $this->context->db->prepare("Select * from candidato where Id= ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $candidato->codigo = $row->Id;
                $candidato->nombre = $row->Nombre;
                $candidato->apellido = $row->Apellido;
                $candidato->partido = $row->Partido;
                $candidato->puesto = $row->Puesto;
                $candidato->profilePhoto = $row->FotoPerfil;
                $candidato->status = $row->Estado;
            }
        }

        $stmt->close();
        return $candidato;
    }

    public function Add($entity)
    {
        $stmt = $this->context->db->prepare("insert into candidato (Nombre, Apellido, Partido, Puesto, Estado) values(?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $entity->nombre, $entity->apellido, $entity->partido, $entity->puesto, $entity->status);
        $stmt->execute();
        $stmt->close();

        $candidatoid = $this->context->db->insert_id;


        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {
                $entity->profilePhoto = "";
            } else {
                $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $candidatoid . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/candidatos/', $name, $tmpname, $type, $size);
                if ($success) {
                    $stmt = $this->context->db->prepare("update candidato set FotoPerfil = ? where Id = ?");
                    $stmt->bind_param("si", $name, $candidatoid);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);

        $stmt = $this->context->db->prepare("update candidato set Nombre = ?, Apellido = ?, Partido = ?, Puesto = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssiiii", $entity->nombre, $entity->apellido, $entity->partido, $entity->puesto, $entity->status, $codigo);
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

                $success = $this->utilities->uploadImage('../assets/img/candidatos/', $name, $tmpname, $type, $size);
                if ($success) {
                    $stmt = $this->context->db->prepare("update candidato set FotoPerfil = ? where Id = ?");
                    $stmt->bind_param("si", $name, $codigo);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    public function Delete($codigo)
    {
        $stmt = $this->context->db->prepare("delete from candidato where Id = ?");
        $stmt->bind_param("i", $codigo);
        $stmt->execute();
        $stmt->close();

    }
}
