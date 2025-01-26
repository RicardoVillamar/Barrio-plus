<?php
//Autor: Freire Chavez Jose Andres
class EstadoContribucion
{
    private $idEstado, $nombreEstado;

    function __construct() {}

    function getIdEstado()
    {
        return $this->idEstado;
    }

    function getNombreEstado()
    {
        return $this->nombreEstado;
    }

    function setIdEstado($idEst)
    {
        $this->idEstado = $idEst;
    }

    function setNombreEstado($nombEst)
    {
        $this->nombreTipo = $nombEst;
    }
}