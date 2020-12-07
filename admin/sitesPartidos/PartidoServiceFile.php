<?php

class PartidoServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->directory = $directory;
        $this->filename = "partidos";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        $ListadoPartidosDecode = $this->filehandler->ReadFile();
        $ListadoPartidos = array();

        if ($ListadoPartidosDecode == false) {

            $this->filehandler->SaveFile($ListadoPartidos);
        } else {

            foreach ($ListadoPartidosDecode as $elementDecode) {
                $element = new Partido();
                $element->set($elementDecode);

                array_push($ListadoPartidos, $element);
            }
        }
        return $ListadoPartidos;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoPartidos = $this->GetList();
        $partido = $this->utilities->searchProperty($ListadoPartidos, 'codigo', $codigo)[0];
        return $partido;
    }

    public function Add($entity)
    {
        $ListadoPartidos = $this->GetList();
        $partidoid = 1;

        if (!empty($ListadoPartidos)) {
            $lastPartido = $this->utilities->getLastElement($ListadoPartidos);
            $partidoid = $lastPartido->codigo + 1;
        }
        $entity->codigo = $partidoid;
        $entity->profilePhoto = "";

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
                    $entity->profilePhoto = $name;
                }
            }
        }


        array_push($ListadoPartidos, $entity);

        $this->filehandler->SaveFile($ListadoPartidos);
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoPartidos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoPartidos, 'codigo', $codigo);

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
                    $entity->profilePhoto = $name;
                }
            }
        }

        $ListadoPartidos[$elementIndex] = $entity;

        $this->filehandler->SaveFile($ListadoPartidos);
    }

    public function Delete($codigo)
    {
        $ListadoPartidos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoPartidos, 'codigo', $codigo);

        unset($ListadoPartidos[$elementIndex]);

        $ListadoPartidos = array_values($ListadoPartidos);

        $this->filehandler->SaveFile($ListadoPartidos);
    }
}
