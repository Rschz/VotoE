<?php
interface IPuesto
{
    public function GetByCiudadano($idCidudadano, $idEleccion);
    public function GetAll();
    public function GetById($id);
    public function Add($obj);
    public function Update($obj);
    public function Delete($id);
}

?>