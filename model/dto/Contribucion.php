<!-- Autor: Freire Chavez Jose Andres -->
<?php
class Contribucion{
    private $id, $estado, $idHerramienta, $idInstalacion, $idUsuario;
    
    function __construct(){
        
    }

    function getId(){
        return $this->id;
    }

    function getEstado(){
        return $this->estado;
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

    function setEstado($estado){
        $this->estado = $estado;
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