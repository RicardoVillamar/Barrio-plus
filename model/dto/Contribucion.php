<!-- Autor: Freire Chavez Jose Andres -->
<?php
class Contribucion{
    private $id, $tipo, $estado, $idRecurso, $idUsuario;
    
    function __construct(){
        
    }

    function getId(){
        return $this->id;
    }

    function getTipo(){
        return $this->tipo;
    }

    function getEstado(){
        return $this->estado;
    }

    function getIdRecurso(){
        return $this->idRecurso;
    }

    function getIdUsuario(){
        return $this->idUsuario;
    }

    function setId($id){
        $this->id = $id;
    }

    function setTipo($tipo){
        $this->tipo = $tipo;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function setIdRecurso($idRecurso){
        $this->idRecurso = $idRecurso;
    }

    function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
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