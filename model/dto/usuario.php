<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php 
class Usuario{
    private $id, $nombre, $apellido, $correo, $contrasena, $rol, $imagen;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }


    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getrol() {
        return $this->rol;
    }
    function getImagen() {
        return $this->imagen;
    }
    //  setter
   function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }
     
    function setRol($rol) {
        $this->rol = $rol;
    }
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
  
    public function __set($atributo, $valor) {
        if (property_exists("Usuario", $atributo)) {
            $this->$atributo = $valor;
        } else {
            echo $atributo . " no existe.";
        }
    }

    public function __get($atributo) {
        if (property_exists("Usuario", $atributo)) {
            return $this->$atributo;
        }
        return null;
    }
}










?>