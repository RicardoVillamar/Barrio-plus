<?php 
require_once 'config/Conexion.php';

class UsuarioDAO {
     
    private $con;

    public function __construct(){
        $this->con =Conexion :: getConexion(); 
    }



}

?>