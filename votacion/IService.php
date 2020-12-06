<?php
interface IVotacion
{
    public function HaVotado($idEleccion,$docId);
    public function GetById($id);
    public function Add($obj);
    public function Update($obj);
    public function Delete($id);
}

?>