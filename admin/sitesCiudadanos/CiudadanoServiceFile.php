<?php

class CiudadanoServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->directory = $directory;
        $this->filename = "ciudadanos";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        $ListadoCiudadanosDecode = $this->filehandler->ReadFile();
        $ListadoCiudadanos = array();

        if ($ListadoCiudadanosDecode == false) {

            $this->filehandler->SaveFile($ListadoCiudadanos);
        } else {

            foreach ($ListadoCiudadanosDecode as $elementDecode) {
                $element = new Ciudadano();
                $element->set($elementDecode);

                array_push($ListadoCiudadanos, $element);
            }
        }
        return $ListadoCiudadanos;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoCiudadanos = $this->GetList();
        $ciudadano = $this->utilities->searchProperty($ListadoCiudadanos, 'codigo', $codigo)[0];
        return $ciudadano;
    }

    public function Add($entity)
    {
        $ListadoCiudadanos = $this->GetList();
        $ciudadanoid = 1;

        if (!empty($ListadoCiudadanos)) {
            $lastCiudadano = $this->utilities->getLastElement($ListadoCiudadanos);
            $ciudadanoid = $lastCiudadano->codigo + 1;
        }
        $entity->codigo = $ciudadanoid;

        array_push($ListadoCiudadanos, $entity);

        $this->filehandler->SaveFile($ListadoCiudadanos);
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoCiudadanos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoCiudadanos, 'codigo', $codigo);

        $ListadoCiudadanos[$elementIndex] = $entity;

        $this->filehandler->SaveFile($ListadoCiudadanos);
    }

    public function Delete($codigo)
    {
        $ListadoCiudadanos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoCiudadanos, 'codigo', $codigo);

        unset($ListadoCiudadanos[$elementIndex]);

        $ListadoCiudadanos = array_values($ListadoCiudadanos);

        $this->filehandler->SaveFile($ListadoCiudadanos);
    }
}
