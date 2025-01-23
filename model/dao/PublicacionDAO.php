<!-- Freire Chavez Jose Andres -->
<?php
require_once 'config/Conexion.php';

class PublicacionesDAO{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function selectAll($parametro){
        try{
            $sql = "select p.idPubli, p.titulo, p.tipo, p.descripcion, p.prioridad, p.fechaEvento,
            u.nombres, u.telefono, u.correo from publicaciones p JOIN usuarios u on p.idUsuario = u.idUsuario
            where p.tipo LIKE :tip or p.prioridad LIKE :pri";
            $stmt = $this->con->prepare($sql);
            $coincidencias = '%'. $parametro .'%';
            $stmt->bindParam(":tip", $coincidencias, PDO::PARAM_STR);
            $stmt->bindParam(":pri", $coincidencias, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(PDOException $er){
            error_log("Error en selectAll de PublicacionesDAO " . $er->getMessage());
            return[];
        }
    }

    public function selectOne($id){
        try{
            $sql = "select p.idPubli, p.titulo, p.tipo, p.descripcion, p.prioridad, p.fechaEvento,
            u.nombres, u.telefono, u.correo from publicaciones p JOIN usuarios u on p.idUsuario = u.idUsuario";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }catch(PDOException $er){
            error_log("Error en selectOne de PublicacionesDAO " . $er->getMessage());
            return null;
        }
    }

    public function insert($publicacion){
        try{
            $sql = "insert into publicaciones (titulo, tipo, descripcion, prioridad,
            fechaEvento, notificarAdmin, idUsuario) values(:tit, :tip, :descrip, :pri, :fech, :notif, :idUsu)";
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
        }catch(PDOException $er){
            error_log("Error en insert de PublicacionesDAO " . $er->getMessage());
            return false;
        }
    }

    public function update($publicacion){
        try{
            $sql = "update publicaciones set titulo=:tit, tipo=:tip, descripcion=:descrip, prioridad=:pri,
            fechaEvento=:fech, notificarAdmin=:notif, idUsuario=:idUsu where idPubli=:id";
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
        }catch(PDOException $er){
            error_log("Error en update de PublicacionesDAO " . $er->getMessage());
            return false;
        }
    }

    public function delete($id){
        try{
            $sql = "delete from publicaciones where idPubli=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $publicacion->getId(), PDO::PARAM_INT);
            $res = $stmt->execute(); 
            return $res;
        }catch(PDOException $er){
            error_log("Error en update de PublicacionesDAO " . $er->getMessage());
            return false;
        }
    }
}
?>