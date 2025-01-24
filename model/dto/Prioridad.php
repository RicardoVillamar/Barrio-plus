<!-- Autor: Freire Chavez Jose Andres -->
<?php
class Prioridad
{
    private $idPrioridad, $nivel;

    function __construct() {}

    function getIdPrioridad()
    {
        return $this->idPrioridad;
    }

    function getNivel()
    {
        return $this->nivel;
    }

    function setIdPrioridad($idPriori)
    {
        $this->idPrioridad = $idPriori;
    }

    function setNivel($niv)
    {
        $this->nivel = $niv;
    }
}