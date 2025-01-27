<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
class Reservacion
{
    private $idReservacion;
    private $idEstadoFK;
    private $idElementoFK; 
    private $tipoElemento; 
    private $idUsuarioFK;
    private $cantidad; 
    private $fechaInicio;
    private $fechaFin;
    private $proposito;
    private $capacitacion; 
    private $personasEsperadas; 
    private $observaciones; 
    private $nombreElemento;
    private $nombreUsuario;

    public function __construct(
        $idReservacion, $idEstadoFK, $idElementoFK, $tipoElemento, $idUsuarioFK, 
        $cantidad, $fechaInicio, $fechaFin, $proposito, 
        $capacitacion, $personasEsperadas, $observaciones
    ) {
        $this->idReservacion = $idReservacion;
        $this->idEstadoFK = $idEstadoFK;
        $this->idElementoFK = $idElementoFK;
        $this->tipoElemento = $tipoElemento;
        $this->idUsuarioFK = $idUsuarioFK;
        $this->cantidad = $cantidad;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->proposito = $proposito;
        $this->capacitacion = $capacitacion;
        $this->personasEsperadas = $personasEsperadas;
        $this->observaciones = $observaciones;
        $this->nombreElemento = null;
        $this->nombreUsuario = null;
    }
   
    public function getNombreElemento() {
        return $this->nombreElemento;
    }

    public function setNombreElemento($nombreElemento) {
        $this->nombreElemento = $nombreElemento;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getIdReservacion() {
        return $this->idReservacion;
    }

    public function getIdEstadoFK() {
        return $this->idEstadoFK;
    }

    public function getIdElementoFK() {
        return $this->idElementoFK;
    }

    public function getTipoElemento() {
        return $this->tipoElemento;
    }

    public function getIdUsuarioFK() {
        return $this->idUsuarioFK;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function getProposito() {
        return $this->proposito;
    }

    public function getCapacitacion() {
        return $this->capacitacion;
    }

    public function getPersonasEsperadas() {
        return $this->personasEsperadas;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function setIdReservacion($idReservacion) {
        $this->idReservacion = $idReservacion;
    }

    public function setIdEstadoFK($idEstadoFK) {
        $this->idEstadoFK = $idEstadoFK;
    }

    public function setIdElementoFK($idElementoFK) {
        $this->idElementoFK = $idElementoFK;
    }

    public function setTipoElemento($tipoElemento) {
        $this->tipoElemento = $tipoElemento;
    }

    public function setIdUsuarioFK($idUsuarioFK) {
        $this->idUsuarioFK = $idUsuarioFK;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function setProposito($proposito) {
        $this->proposito = $proposito;
    }

    public function setCapacitacion($capacitacion) {
        $this->capacitacion = $capacitacion;
    }

    public function setPersonasEsperadas($personasEsperadas) {
        $this->personasEsperadas = $personasEsperadas;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
}
