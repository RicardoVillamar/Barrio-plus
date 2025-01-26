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
            $sql = "select * from contribucion c
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

    /*
    public function update($publicacion)
    {
        try {
            $sql = "update publicacion set titulo=:tit, tipo=:tip, descripcion=:descrip, prioridad=:pri,
            fechaEvento=:fech, notificarAdmin=:notif, idUsuarioFK=:idUsu where idPubli=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tit", $publicacion->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(":tip", $publicacion->getTipo(), PDO::PARAM_STR);
            $stmt->bindParam(":descrip", $publicacion->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":pri", $publicacion->getPrioridad(), PDO::PARAM_STR);
            $stmt->bindParam(":fech", $publicacion->getFechaEvento(), PDO::PARAM_STR);
            $stmt->bindParam(":notif", $publicacion->getNotificarAdmin(), PDO::PARAM_INT);
            $stmt->bindParam(":idUsu", $publicacion->getIdUsu(), PDO::PARAM_INT);
            $stmt->bindParam(":id", $publicacion->getId(), PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en update de PublicacionDAO " . $er->getMessage());
            return false;
        }
    }
    */

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