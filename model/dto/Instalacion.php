<!-- Autor: Villamar Minuche Ricardo Daniel -->

<?php

class Instalaciones
{
    private $idInstalacion, $nombre, $descripcion, $precio, $tamano, $idTipoFK, $idEstadoFK, $idContribuidorFK, $imagen;

    function __construct() {}

    function getIdInstalacion()
    {
        return $this->idInstalacion;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getTamano()
    {
        return $this->tamano;
    }

    function getIdTipoFK()
    {
        return $this->idTipoFK;
    }

    function getIdEstadoFK()
    {
        return $this->idEstadoFK;
    }

    function getIdContribuidorFK()
    {
        return $this->idContribuidorFK;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setIdInstalacion($idInstalacion)
    {
        $this->idInstalacion = $idInstalacion;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    function setTamano($tamano)
    {
        $this->tamano = $tamano;
    }

    function setIdTipoFK($idTipoFK)
    {
        $this->idTipoFK = $idTipoFK;
    }

    function setIdEstadoFK($idEstadoFK)
    {
        $this->idEstadoFK = $idEstadoFK;
    }

    function setIdContribuidorFK($idContribuidorFK)
    {
        $this->idContribuidorFK = $idContribuidorFK;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}


?>