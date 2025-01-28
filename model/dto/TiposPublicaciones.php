<?php
//Autor: Freire Chavez Jose Andres
class TiposPublicaciones
{
    private $idTipo, $nombreTipo;

    function __construct() {}

    function getIdTipo()
    {
        return $this->idTipo;
    }

    function getNombreTipo()
    {
        return $this->nombreTipo;
    }

    function setIdTipo($idTip)
    {
        $this->idTipo = $idTip;
    }

    function setNombre($nombTip)
    {
        $this->nombreTipo = $nombTip;
    }
}