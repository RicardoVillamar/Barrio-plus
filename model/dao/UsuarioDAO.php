<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php
require_once 'config/Conexion.php';

class UsuarioDAO
{

    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectAll($parametro)
    {
        try {
            $sql = "select * from usuario where nombre like :b1 or apellido like :b2 or correo like :b3";
            $stmt = $this->con->prepare($sql);
            $conlike = '%' . $parametro . '%';
            $stmt->bindParam(":b1", $conlike, PDO::PARAM_STR);
            $stmt->bindParam(":b2", $conlike, PDO::PARAM_STR);
            $stmt->bindParam(":b3", $conlike, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en selectAll de UsuarioDAO " . $er->getMessage());
            echo "Error en selectAll de UsuarioDAO " . $er->getMessage();
            return [];
        }
    }

    public function selectOne($userId)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserById($userId)
{
    $query = "SELECT * FROM usuario WHERE idUsuario = :idUsuario";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':idUsuario', $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    public function selectReservasHerramientasByUserId($userId)
    {
        $sql = "SELECT * FROM ReservacionHerramienta WHERE idUsuarioFK = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectReservasInstalacionesByUserId($userId)
    {
        $sql = "SELECT * FROM ReservacionInstalacion WHERE idUsuarioFK = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectOneByEmail($correo)
    {
        $sql = "SELECT * FROM usuario WHERE correo = :correo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function insert($usuario)
    {
        try {
            $sql = "insert into usuario (nombre, apellido, correo, contrasena, idRolFK) VALUES (:nom, :ape, :cor, :con, :rol)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":nom", $usuario['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":ape", $usuario['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(":cor", $usuario['correo'], PDO::PARAM_STR);
            $stmt->bindParam(":con", $usuario['contrasena'], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $usuario['rol'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $er) {
            error_log("Error en insert de UsuarioDAO " . $er->getMessage());
            return false;
        }
    }
  

    public function update($usuario)
    {
        try {
            $sql = "UPDATE usuario SET nombre=:nom, apellido=:ape, correo=:cor, contrasena=:con WHERE idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":nom", $usuario['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":ape", $usuario['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(":cor", $usuario['correo'], PDO::PARAM_STR);
            $stmt->bindParam(":con", $usuario['contrasena'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $usuario['idUsuario'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $er) {
            error_log("Error en update de UsuarioDAO " . $er->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "delete from usuario where idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOEXception $er) {
            error_log("Error en delete de UsuarioDAO " . $er->getMessage());
            return false;
        }
    }

    public function login($correo, $contrasena)
    {
        try {
            $sql = "select * from usuario where correo=:cor";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":cor", $correo, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($res == null) {
                return null;
            }
            if (password_verify($contrasena, $res['contrasena'])) {
                return $res;
            } else {
                return null;
            }
        } catch (PDOEXception $er) {
            error_log("Error en login de UsuarioDAO " . $er->getMessage());
            return null;
        }
    }
}

?>