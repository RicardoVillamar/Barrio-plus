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
        $sql = "SELECT 
                    rh.idReservacion AS IdReservacion, 
                    h.nombre AS Herramienta, 
                    rh.fechaInicio AS FechaInicio, 
                    rh.fechaFin AS FechaFin, 
                    rh.cantidad AS Cantidad
                FROM ReservacionHerramienta rh
                JOIN Herramienta h ON rh.idHerramientaFK = h.idHerramienta
                WHERE rh.idUsuarioFK = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function selectReservasInstalacionesByUserId($userId)
    {
        $sql = "SELECT 
                    ri.idReservacion AS IdReservacion, 
                    i.nombre AS Instalacion, 
                    ri.fechaInicio AS FechaInicio, 
                    ri.fechaFin AS FechaFin, 
                    ri.personasEsperadas AS PersonasEsperadas
                FROM ReservacionInstalacion ri
                JOIN Instalacion i ON ri.idInstalacionFK = i.idInstalacion
                WHERE ri.idUsuarioFK = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function selectOneByNombre($nombre)
    {
        $sql = "SELECT * FROM usuario WHERE nombre = :nombre";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function insert($usuario)
    {
        try {
            $sql = "INSERT INTO usuario (nombre, apellido, correo, contrasena, idRolFK, imagen) VALUES (:nombre, :apellido, :correo, :contrasena, :idRolFK, :imagen)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nombre', $usuario['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $usuario['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':correo', $usuario['correo'], PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $usuario['contrasena'], PDO::PARAM_STR);
            $stmt->bindParam(':idRolFK', $usuario['idRolFK'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $usuario['imagen'], PDO::PARAM_LOB);
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
            $sql = "UPDATE usuario SET nombre=:nom, apellido=:ape, correo=:cor, contrasena=:con, idRolFK=:rol WHERE idUsuario=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":nom", $usuario['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":ape", $usuario['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(":cor", $usuario['correo'], PDO::PARAM_STR);
            $stmt->bindParam(":con", $usuario['contrasena'], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $usuario['idRolFK'], PDO::PARAM_INT);
            //   $stmt->bindParam(':imagen', $usuario['imagen'], PDO::PARAM_LOB);
            $stmt->bindParam(":id", $usuario['idUsuario'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $er) {
            error_log("Error en update de UsuarioDAO " . $er->getMessage());
            return false;
        }
    }

    public function buscarReservasPorHerramienta($idUsuario, $query)
    {
        $sql = "SELECT rh.*, h.nombre 
                FROM ReservacionHerramienta rh
                JOIN Herramienta h ON rh.idHerramientaFK = h.idHerramienta
                WHERE rh.idUsuarioFK = :idUsuario 
                AND h.nombre LIKE :nombreHerramienta";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':nombreHerramienta', $query, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarReservasPorInstalacion($idUsuario, $nombreInstalacion)
    {
        $sql = "SELECT ri.*, i.nombre 
                FROM ReservacionInstalacion ri
                JOIN Instalacion i ON ri.idInstalacionFK = i.idInstalacion
                WHERE ri.idUsuarioFK = :idUsuario 
                AND i.nombre LIKE :nombreInstalacion";

        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindValue(':nombreInstalacion', '%' . $nombreInstalacion . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleById($userId)
    {
        $query = "SELECT idRolFK FROM usuario WHERE id = :userId";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
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

    public function deleteReservationHerrById($reservationId)
    {
        try {
            $sql = "DELETE FROM ReservacionHerramienta WHERE idReservacion = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $er) {
            error_log("Error en deleteReservationById de UsuarioDAO " . $er->getMessage());
            return false;
        }
    }

    public function deleteReservationInstById($reservationId)
    {
        try {
            $sql = "DELETE FROM ReservacionInstalacion WHERE idReservacion = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $er) {
            error_log("Error en deleteReservationInstById de UsuarioDAO: " . $er->getMessage());
            return false;
        }
    }
}

?>