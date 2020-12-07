<?php

class EleccionServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->directory = $directory;
        $this->filename = "elecciones";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        $ListadoEleccionesDecode = $this->filehandler->ReadFile();
        $ListadoElecciones = array();

        if ($ListadoEleccionesDecode == false) {

            $this->filehandler->SaveFile($ListadoElecciones);
        } else {

            foreach ($ListadoEleccionesDecode as $elementDecode) {
                $element = new Eleccion();
                $element->set($elementDecode);

                array_push($ListadoElecciones, $element);
            }
        }
        return $ListadoElecciones;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoElecciones = $this->GetList();
        $eleccion = $this->utilities->searchProperty($ListadoElecciones, 'codigo', $codigo)[0];
        return $eleccion;
    }

    public function Add($entity)
    {
        $ListadoElecciones = $this->GetList();
        $eleccionid = 1;

        if (!empty($ListadoElecciones)) {
            $lastEleccion = $this->utilities->getLastElement($ListadoElecciones);
            $eleccionid = $lastEleccion->codigo + 1;
        }
        $entity->codigo = $eleccionid;

        array_push($ListadoElecciones, $entity);

        $this->filehandler->SaveFile($ListadoElecciones);
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoElecciones = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoElecciones, 'codigo', $codigo);

        $ListadoElecciones[$elementIndex] = $entity;

        $this->filehandler->SaveFile($ListadoElecciones);
    }

    public function Delete($codigo)
    {
        $ListadoElecciones = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoElecciones, 'codigo', $codigo);

        unset($ListadoElecciones[$elementIndex]);

        $ListadoElecciones = array_values($ListadoElecciones);

        $this->filehandler->SaveFile($ListadoElecciones);
    }
}
