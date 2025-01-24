<!-- Autor: Freire Chavez Jose Andres -->
<?php
class Publicacion{
    private $id, $titulo, $idTipo, $descripcion, $idPrioridad, $fechaEvento,
    $notificarAdmin, $idUsuario;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getIdTipo() {
        return $this->idTipo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIdPrioridad() {
        return $this->idPrioridad;
    }
    
    function getFechaEvento() {
        return $this->fechaEvento;
    }
   
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNotificarAdmin() {
        return $this->notificarAdmin;
    }

    function setId($id){
        $this->id = $id;
    }

    function setTitulo($tit){
        $this->titulo = $tit;
    }

    function setIdTipo($idTip){
        $this->idTipo = $idTip;
    }

    function setDescripcion($des) {
        $this->descripcion = $des;
    }

    function setIdPrioridad($idPrio) {
        $this->idPrioridad = $idPrio;
    }

    function setFechaEvento($fecha){
        $this->fechaEvento = $fecha;
    }

    function setIdUsuario($idUsu) {
        $this->idUsuario = $idUsu;
    }

    function setNotificarAdmin($notif) {
        $this->notificarAdmin = $notif;
    }
    
    public function __set($atributo, $valor) {
        if (property_exists("Publicacion", $atributo)) {
            $this->$atributo = $valor;
        } else {
            echo $atributo . "no existe";
        }
    }

    public function __get($atributo) {
        if (property_exists("Publicacion", $atributo)) {
            return $this->$atributo;
        }
        return null;
    }
}
?>