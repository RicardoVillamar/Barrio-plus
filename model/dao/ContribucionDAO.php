<?php
//Autor: Freire Chavez Jose Andres
require_once 'config/Conexion.php';

class ContribucionDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectAll($parametro)
    {
        try {
            $sql = "select
            c.idContribucion,
            h.idHerramienta,
            h.nombre as nombreHerramienta,
            i.idInstalacion,
            i.nombre as nombreInstalacion,
            u.idUsuario,
            u.nombre as nombreUsuario,
            u.apellido as apellidoUsuario,
            u.correo as correoUsuario
            from contribucion c
            JOIN usuario u on c.idUsuarioFK = u.idUsuario
            JOIN estadocontribucion ec on c.idEstadoContribucionFK = ec.idEstadoContribucion
            LEFT JOIN herramienta h on c.idHerramientaFK = h.idHerramienta
            LEFT JOIN instalacion i on c.idInstalacionFK = i.idInstalacion
            where h.nombre LIKE :nombH or i.nombre LIKE :nombI";
            $stmt = $this->con->prepare($sql);
            $coincidencias = '%' . $parametro . '%';
            $stmt->bindParam(":nombH", $coincidencias, PDO::PARAM_STR);
            $stmt->bindParam(":nombI", $coincidencias, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en selectAll de ContribucionDAO " . $er->getMessage());
            return [];
        }
    }

    public function selectOne($id)
    {
        try {
            $sql = "select * from contribucion c
            JOIN usuario u on c.idUsuarioFK = u.idUsuario
            JOIN estadocontribucion ec on c.idEstadoContribucionFK = ec.idEstadoContribucions
            LEFT JOIN herramienta h on c.idHerramientaFK = h.idHerramienta
            LEFT JOIN instalacion i on c.idInstalacionFK = i.idInstalacion
            where c.idContribucion=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en selectOne de ContribucionDAO " . $er->getMessage());
            return null;
        }
    }


    public function insert($contribucion)
    {
        try {
            $sql = "insert into contribucion (idEstadoContribucionFK, idHerramientaFK, 
            idInstalacionFK, idUsuarioFK) values(:idEst, :idHerr, :idIns, :idUsu)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":idEst", $contribucion->getIdEstado(), PDO::PARAM_INT);
            $stmt->bindParam(":idHerr", $contribucion->getIdHerramienta(), PDO::PARAM_INT);
            $stmt->bindParam(":idIns", $contribucion->getIdInstalacion(), PDO::PARAM_INT);
            $stmt->bindParam(":idUsu", $contribucion->getIdUsuario(), PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en insert de ContribucionDAO " . $er->getMessage());
            return false;
        }
    }

    public function update($contribucion)
    {
        try {
            $sql = "update contribucion set idEstadoContribucionFK=:idEst, idHerramientaFK=:idHerr, 
            idInstalacionFK=:idIns, idUsuarioFK=:idUsu where idContribucion=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":idEst", $contribucion->getIdEstado(), PDO::PARAM_INT);
            $stmt->bindParam(":idHerr", $contribucion->getIdHerramienta(), PDO::PARAM_INT);
            $stmt->bindParam(":idIns", $contribucion->getIdInstalacion(), PDO::PARAM_INT);
            $stmt->bindParam(":idUsu", $contribucion->getIdUsuario(), PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en update de ContribucionDAO " . $er->getMessage());
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $sql = "delete from contribucion where idContribucion=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en delete de ContribucionDAO " . $er->getMessage());
            return false;
        }
    }
}
?>