<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
class Reservacion
{
    private $idReservacion;
    private $herramienta;
    private $usuario;
    private $cantidad;
    private $fechaInicio;
    private $fechaFin;
    private $estado;

    public function getIdReservacion()
    {
        return $this->idReservacion;
    }

    public function setIdReservacion($idReservacion)
    {
        $this->idReservacion = $idReservacion;
    }

    public function getHerramienta()
    {
        return $this->herramienta;
    }

    public function setHerramienta($herramienta)
    {
        $this->herramienta = $herramienta;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
