<?php
//Autor: Villamar Minuche Ricardo Daniel


class Instalaciones
{
    private $idInstalacion, $nombre, $descripcion, $precio, $tamano, $idTipoFK, $idEstadoFK, $imagen;

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



    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}
