<?php
interface ICandidato
{
    public function GetAll();
    public function GetByPuesto($idPuesto);
    public function GetById($id);
    public function Add($obj);
    public function Update($obj);
    public function Delete($id);
}

?>