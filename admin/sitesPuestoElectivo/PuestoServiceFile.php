<?php

class PuestoServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->directory = $directory;
        $this->filename = "puestos";
        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        $ListadoPuestosDecode = $this->filehandler->ReadFile();
        $ListadoPuestos = array();

        if ($ListadoPuestosDecode == false) {

            $this->filehandler->SaveFile($ListadoPuestos);
        } else {

            foreach ($ListadoPuestosDecode as $elementDecode) {
                $element = new Puesto();
                $element->set($elementDecode);

                array_push($ListadoPuestos, $element);
            }
        }
        return $ListadoPuestos;
    }




    public function GetByCodigo($codigo)
    {
        $ListadoPuestos = $this->GetList();
        $puesto = $this->utilities->searchProperty($ListadoPuestos, 'codigo', $codigo)[0];
        return $puesto;
    }

    public function Add($entity)
    {
        $ListadoPuestos = $this->GetList();
        $puestoid = 1;

        if (!empty($ListadoPuestos)) {
            $lastPuesto = $this->utilities->getLastElement($ListadoPuestos);
            $puestoid = $lastPuesto->codigo + 1;
        }
        $entity->codigo = $puestoid;

        array_push($ListadoPuestos, $entity);

        $this->filehandler->SaveFile($ListadoPuestos);
    }

    public function Update($codigo, $entity)
    {
        $element = $this->GetByCodigo($codigo);
        $ListadoPuestos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoPuestos, 'codigo', $codigo);

        $ListadoPuestos[$elementIndex] = $entity;

        $this->filehandler->SaveFile($ListadoPuestos);
    }

    public function Delete($codigo)
    {
        $ListadoPuestos = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($ListadoPuestos, 'codigo', $codigo);

        unset($ListadoPuestos[$elementIndex]);

        $ListadoPuestos = array_values($ListadoPuestos);

        $this->filehandler->SaveFile($ListadoPuestos);
    }
}
