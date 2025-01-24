<?php
//autor: Villamar Minuche Ricardo Daniel

class Estado
{
    private $idEstado, $nombre;

    function __construct() {}

    function getIdEstado()
    {
        return $this->idEstado;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
