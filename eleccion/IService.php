<?php
interface IEleccion
{
    public function ActiveEleccion();
    public function GetById($id);
    public function Add($obj);
    public function Update($obj);
    public function Delete($id);
}

?>