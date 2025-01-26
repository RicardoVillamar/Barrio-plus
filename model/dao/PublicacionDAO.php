<!-- Autor: Freire Chavez Jose Andres -->
<?php
require_once 'config/Conexion.php';

class PublicacionDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectAll($parametro)
    {
        try {
            $sql = "select p.idPubli, p.titulo, tp.nombreTipo, p.descripcion, prio.nivel, p.fechaEvento,
            u.nombre, u.apellido, u.correo from publicacion p 
            JOIN usuario u on p.idUsuarioFK = u.idUsuario
            JOIN tipopublicacion tp on p.idTipoFK = tp.idTipo
            JOIN prioridad prio on p.idPrioridadFK = prio.idPrioridad
            where tp.nombreTipo LIKE :tip or prio.nivel LIKE :pri";
            $stmt = $this->con->prepare($sql);
            $coincidencias = '%' . $parametro . '%';
            $stmt->bindParam(":tip", $coincidencias, PDO::PARAM_STR);
            $stmt->bindParam(":pri", $coincidencias, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en selectAll de PublicacionDAO " . $er->getMessage());
            return [];
        }
    }

    public function selectOne($id)
    {
        try {
            $sql = "select * from publicacion p 
            JOIN usuario u on p.idUsuarioFK = u.idUsuario
            JOIN tipopublicacion tp on p.idTipoFK = tp.idTipo
            JOIN prioridad prio on p.idPrioridadFK = prio.idPrioridad
            where p.idPubli=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en selectOne de PublicacionDAO " . $er->getMessage());
            return null;
        }
    }

    public function insert($publicacion)
    {
        try {
            $sql = "insert into publicacion (titulo, idTipoFK, descripcion, idPrioridadFK,
            fechaEvento, notificarAdmin, idUsuarioFK) values(:tit, :tip, :descrip, :pri, :fech, :notif, :idUsu)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tit", $publicacion->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(":tip", $publicacion->getIdTipo(), PDO::PARAM_INT);
            $stmt->bindParam(":descrip", $publicacion->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":pri", $publicacion->getIdPrioridad(), PDO::PARAM_INT);
            $stmt->bindParam(":fech", $publicacion->getFechaEvento(), PDO::PARAM_STR);
            $stmt->bindParam(":notif", $publicacion->getNotificarAdmin(), PDO::PARAM_INT);
            $stmt->bindParam(":idUsu", $publicacion->getIdUsuario(), PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en insert de PublicacionDAO " . $er->getMessage());
            return false;
        }
    }

    public function update($publicacion)
    {
        try {
            $sql = "update publicacion set titulo=:tit, idTipoFK=:tip, descripcion=:descrip, idPrioridadFK=:pri,
            fechaEvento=:fech, notificarAdmin=:notif, idUsuarioFK=:idUsu where idPubli=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tit", $publicacion->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(":tip", $publicacion->getTipo(), PDO::PARAM_INT);
            $stmt->bindParam(":descrip", $publicacion->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":pri", $publicacion->getPrioridad(), PDO::PARAM_INT);
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

    public function delete($id)
    {
        try {
            $sql = "delete from publicacion where idPubli=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en update de PublicacionDAO " . $er->getMessage());
            return false;
        }
    }
}
?>