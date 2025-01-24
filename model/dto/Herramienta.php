<?php
//autor: Quiñonez Castrellón Anthony Joel
class Herramienta{
    private $id, $nombre, $img, $descrip, $precio, 
    $fechaRegis, $idEst, $mant, $cant, $idContri;
    
    function __construct() {}
    
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    
    function getImg() {
        return $this->img;
    }
    
    function getDescrip() {
        return $this->descrip;
    }
    function getPrecio() {
        return $this->precio;
    }
    
    function getFechaRegis() {
        return $this->fechaRegis;
    }
    
    function getIdEst() {
        return $this->idEst;
    }
    
    function getMant() {
        return $this->mant;
    }
    
    function getCant() {
        return $this->cant;
    }
    function getIdContri() {
        return $this->idContri;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function setImg($img) {
        $this->img = $img;
    }
    
    function setDescrip($descrip) {
        $this->descrip = $descrip;
    }
    
    function setPrecio($precio) {
        $this->precio = $precio;
    }
    
    function setFechaRegis($fechaRegis) {
        $this->fechaRegis = $fechaRegis;
    }
    
    function setIdEst($idEst) {
        $this->idEst = $idEst;
    }
    
    function setMant($mant) {
        $this->mant = $mant;
    }
    
    function setCant($cant) {
        $this->cant = $cant;
    }
    
    function setIdContri($idContri) {
        $this->idContri = $idContri;
    }
}
?>
