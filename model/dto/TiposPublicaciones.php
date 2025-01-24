<!-- Autor: Freire Chavez Jose Andres -->
<?php
class TiposPublicaciones
{
    private $idTipo, $descripcion;

    function __construct() {}

    function getIdTipo()
    {
        return $this->idTipo;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    function setDescripcion($descrip)
    {
        $this->descripcion = $descrip;
    }
}