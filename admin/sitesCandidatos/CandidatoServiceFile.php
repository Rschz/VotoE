<?php

class CandidatoServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->directory = $directory;
        $this->filename = "candidatos";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        $ListadoCandidatosDecode = $this->filehandler->ReadFile();
        $ListadoCandidatos = array();

        if ($ListadoCandidatosDecode == false) {

            $this->filehandler->SaveFile($ListadoCandidatos);
        } else {

            foreach ($ListadoCandidatosDecode as $elementDecode) {
                $element = new Candidato();
                $element->set($elementDecode);

                array_push($ListadoCandidatos, $element);
            }
        }
        return $ListadoCandidatos;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoCandidatos = $this->GetList();
        $candidato = $this->utilities->searchProperty($ListadoCandidatos, 'codigo', $codigo)[0];
        return $candidato;
    }

    public function Add($entity)
    {
        $ListadoCandidatos = $this->GetList();
        $candidatoid = 1;

        if (!empty($ListadoCandidatos)) {
            $lastCandidato = $this->utilities->getLastElement($ListadoCandidatos);
            $candidatoid = $lastCandidato->codigo + 1;
        }
        $entity->codigo = $candidatoid;
        $entity->profilePhoto = "";

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
                    $entity->profilePhoto = $name;
                }
            }
        }

        array_push($ListadoCandidatos, $entity);

        $this->filehandler->SaveFile($ListadoCandidatos);
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoCandidatos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoCandidatos, 'codigo', $codigo);
       
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
                    $entity->profilePhoto = $name;
                }
            }
        }

        $ListadoCandidatos[$elementIndex] = $entity;

        $this->filehandler->SaveFile($ListadoCandidatos);
    }

    public function Delete($codigo)
    {
        $ListadoCandidatos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoCandidatos, 'codigo', $codigo);

        unset($ListadoCandidatos[$elementIndex]);

        $ListadoCandidatos = array_values($ListadoCandidatos);

        $this->filehandler->SaveFile($ListadoCandidatos);
    }
}
