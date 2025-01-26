<!-- Autor: Villamar Minuche Ricardo Daniel -->
<?php

class Tipos
{
    private $idTipo, $nombre;

    function __construct() {}

    function getIdTipo()
    {
        return $this->idTipo;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
