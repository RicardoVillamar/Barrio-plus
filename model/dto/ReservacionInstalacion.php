<!-- Autor: Ricardo Daniel Villamar Minuche -->
<?php

class ReservacionInstalacion
{
    private $idReservacion;
    private $idInstalacionFK;
    private $idUsuarioFK;
    private $fechaInicio;
    private $fechaFin;
    private $personasEsperadas;
    private $observaciones;
    private $proposito;
    private $idEstadoFK;

    public function getIdReservacion()
    {
        return $this->idReservacion;
    }

    public function setIdReservacion($idReservacion)
    {
        $this->idReservacion = $idReservacion;
    }

    public function getIdEstadoFK()
    {
        return $this->idEstadoFK;
    }

    public function setIdEstadoFK($idEstadoFK)
    {
        $this->idEstadoFK = $idEstadoFK;
    }

    public function getIdInstalacionFK()
    {
        return $this->idInstalacionFK;
    }

    public function setIdInstalacionFK($idInstalacionFK)
    {
        $this->idInstalacionFK = $idInstalacionFK;
    }

    public function getIdUsuarioFK()
    {
        return $this->idUsuarioFK;
    }

    public function setIdUsuarioFK($idUsuarioFK)
    {
        $this->idUsuarioFK = $idUsuarioFK;
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

    public function getPersonasEsperadas()
    {
        return $this->personasEsperadas;
    }

    public function setPersonasEsperadas($personasEsperadas)
    {
        $this->personasEsperadas = $personasEsperadas;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    public function getProposito()
    {
        return $this->proposito;
    }

    public function setProposito($proposito)
    {
        $this->proposito = $proposito;
    }
}
