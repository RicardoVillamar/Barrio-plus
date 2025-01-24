<!-- Autor: Freire Chavez Jose Andres -->
<?php
require_once 'config/Conexion.php';

class ContribucionDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }


    /*
    public function selectAll($parametro)
    {
        try {
            $sql = "select * from contribucion c
            JOIN usuario u on c.idUsuarioFK = u.idUsuario
            LEFT JOIN herramienta h on c.idRecursoFK = h.idHerramienta
            LEFT JOIN instalacion i on c.idRecursoFK = i.idInstalacion";
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
            $sql = "select p.idPubli, p.titulo, p.tipo, p.descripcion, p.prioridad, p.fechaEvento,
            u.nombre, u.apellido, u.correo from publicacion p JOIN usuario u on p.idUsuarioFK = u.idUsuario";
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
            $sql = "insert into publicacion (titulo, tipo, descripcion, prioridad,
            fechaEvento, notificarAdmin, idUsuarioFK) values(:tit, :tip, :descrip, :pri, :fech, :notif, :idUsu)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":tit", $publicacion->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(":tip", $publicacion->getTipo(), PDO::PARAM_STR);
            $stmt->bindParam(":descrip", $publicacion->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":pri", $publicacion->getPrioridad(), PDO::PARAM_STR);
            $stmt->bindParam(":fech", $publicacion->getFechaEvento(), PDO::PARAM_STR);
            $stmt->bindParam(":notif", $publicacion->getNotificarAdmin(), PDO::PARAM_INT);
            $stmt->bindParam(":idUsu", $publicacion->getIdUsu(), PDO::PARAM_INT);
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
    */
}
?>