<?php
//Autor: Freire Chavez Jose Andres
class Contribucion{
    private $id, $idEstado, $idHerramienta, $idInstalacion, $idUsuario;
    
    function __construct(){
        
    }

    function getId(){
        return $this->id;
    }

    function getIdEstado(){
        return $this->idEstado;
    }

    function getIdHerramienta(){
        return $this->idHerramienta;
    }

    function getIdInstalacion(){
        return $this->idInstalacion;
    }

    function getIdUsuario(){
        return $this->idUsuario;
    }

    function setId($id){
        $this->id = $id;
    }

    function setIdEstado($idEst){
        $this->idEstado = $idEst;
    }

    function setIdHerramienta($idHerra){
        $this->idHerramienta = $idHerra;
    }

    function setIdInstalacion($idInst){
        $this->idInstalacion = $idInst;
    }

    function setIdUsuario($idUsu){
        $this->idUsuario = $idUsu;
    }

    public function __set($atributo, $valor) {
        if (property_exists("Contribucion", $atributo)) {
            $this->$atributo = $valor;
        } else {
            echo $atributo . "no existe";
        }
    }

    public function __get($atributo) {
        if (property_exists("Contribucion", $atributo)) {
            return $this->$atributo;
        }
        return null;
    }
}
?>