<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php 
require_once 'config/Conexion.php';

class UsuarioDAO 
{
     
    private $con;

    public function __construct(){
        $this->con =Conexion :: getConexion(); 
    }

    public function selectAll($parametro){
        try{
            $sql="select * from usuario where nombre like :b1 or apellido like :b2 or correo like :b3";
            $stmt = $this->con->prepare($sql);
            $conlike = '%' .$parametro . '%';
            $stmt->bindParam(":b1",$conlike, PDO::PARAM_STR);
            $stmt->bindParam(":b2",$conlike, PDO::PARAM_STR);
            $stmt->bindParam(":b3",$conlike, PDO::PARAM_STR);
            $stmt->execute();
            $res= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(PDOEXception $er){
            error_log("Error en selectAll de UsuarioDAO ". $er->getMessage());
            echo "Error en selectAll de UsuarioDAO ". $er->getMessage();
            return [];
        }

    }
    

    public function selectOne($id){
        try{
            $sql="select * from usuario where idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();
            $res= $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }catch(PDOEXception $er){
            error_log("Error en selectOne de UsuarioDAO ". $er->getMessage());
            return null;
        }
    }

    public function insert($usuario){
        try{
            $sql="insert into usuario (nombre, apellido, correo, contrasena) values(:nom, :ape, :cor, :con)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":nom",$usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":ape",$usuario->getApellido(), PDO::PARAM_STR);
            $stmt->bindParam(":cor",$usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindParam(":con",$usuario->getContrasena(), PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }catch(PDOEXception $er){
            error_log("Error en insert de UsuarioDAO ". $er->getMessage());
            return false;
        }
    }

    public function update($usuario){
        try{
            $sql="update usuario set nombre=:nom, apellido=:ape, correo=:cor, contrasena=:con where idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":nom",$usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":ape",$usuario->getApellido(), PDO::PARAM_STR);
            $stmt->bindParam(":cor",$usuario->getCorreo(), PDO::PARAM_STR);
            $stmt->bindParam(":con",$usuario->getContrasena(), PDO::PARAM_STR);
            $stmt->bindParam(":id",$usuario->getIdUsuario(), PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOEXception $er){
            error_log("Error en update de UsuarioDAO ". $er->getMessage());
            return false;
        }
    }

    public function delete($id){
        try{
            $sql="delete from usuario where idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOEXception $er){
            error_log("Error en delete de UsuarioDAO ". $er->getMessage());
            return false;
        }
    }

    public function login($correo, $contrasena){
        try{
            $sql="select * from usuario where correo=:cor";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":cor",$correo, PDO::PARAM_STR);
            $stmt->execute();
            $res= $stmt->fetch(PDO::FETCH_ASSOC);
            if($res==null){
                return null;
            }
            if(password_verify($contrasena, $res['contrasena'])){
                return $res;
            }else{
                return null;
            }
        }catch(PDOEXception $er){
            error_log("Error en login de UsuarioDAO ". $er->getMessage());
            return null;
        }
    }





}

?>