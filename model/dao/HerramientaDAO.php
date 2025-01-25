<?php
//autor: Quiñonez Castrellón Anthony Joel -->
require_once 'config/Conexion.php';


class HerramientaDAO{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function selectAll() {
        try {
            $sql = 'select 
                        h.idHerramienta, 
                        h.nombre AS nombre, 
                        h.descripcion, 
                        h.precio, 
                        h.imagen, 
                        h.fechaRegistro, 
                        h.mantenimiento, 
                        h.cantidad, 
                        e.nombre AS idEstadoFK,      
                        u.nombre AS idContribuidorFK
                        FROM herramienta h JOIN Estado e ON h.idEstadoFK = e.idEstado 
                        JOIN Usuario u ON h.idContribuidorFK = u.idUsuario;';
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error al obtener la herramienta' . $error->getMessage());
            return [];
        }
    } 

    public function selectOne($id) {
        try {
            $sql = 'select 
                        h.idHerramienta, 
                        h.nombre AS nombre, 
                        h.descripcion, 
                        h.precio, 
                        h.imagen, 
                        h.fechaRegistro, 
                        h.mantenimiento, 
                        h.cantidad, 
                        e.nombre AS idEstadoFK,      
                        u.nombre AS idContribuidorF
                        FROM herramienta h
                        JOIN Estado e ON h.idEstadoFK = e.idEstado
                        JOIN Usuario u ON h.idContribuidorFK = u.idUsuario
                        WHERE 
                        h.idHerramienta = :id';
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            error_log("Error en selectOne de HerramientaDAO: " . $e->getMessage());
            return null;
        }
    }

    public function buscar($nombre = "") {
        try {
            if (!empty($nombre)) {
                $sql = 'SELECT * FROM herramienta WHERE nombre LIKE :nombre';
                $stmt = $this->con->prepare($sql);
                $nombre = "%" . $nombre . "%"; // Permite buscar coincidencias parciales
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            } else {
                $sql = 'SELECT * FROM herramienta';
                $stmt = $this->con->prepare($sql);
            }
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error al obtener las herramientas: ' . $error->getMessage());
            return [];
        }
    }
        // Eliminar un registro
        public function delete($id) {
            try {
                $sql = "DELETE FROM herramienta WHERE idHerramienta = :id";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al eliminar herramienta: " . $e->getMessage());
                return false;
            }
        }

        public function insert($herramienta) {
            try {
                $sql = "insert into herramienta (nombre, descripcion, precio, imagen, fechaRegistro, 
                idEstadoFK, cantidad, mantenimiento,idContribuidorFK) 
                        values (:nombre, :descripcion, :precio,:imagen, :fechaRegistro, 
                        :idEstadoFK, :cantidad, :mantenimiento, :idContribuidorFK)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':nombre',$herramienta->getNombre(), PDO::PARAM_STR);
                $stmt->bindParam(':descripcion',$herramienta->getDescrip(), PDO::PARAM_STR);
                $stmt->bindParam(':precio', $herramienta->getPrecio(), PDO::PARAM_INT);
                $stmt->bindParam(':imagen', $herramienta->getImg(), PDO::PARAM_LOB);
                $stmt->bindParam(':fechaRegistro',$herramienta->getFechaRegis(), PDO::PARAM_STR);
                $stmt->bindParam(':idEstadoFK', $herramienta->getIdEst(), PDO::PARAM_INT);
                $stmt->bindParam(':cantidad', $herramienta->getCant(), PDO::PARAM_INT);
                $stmt->bindParam(':mantenimiento', $herramienta->getMant(), PDO::PARAM_INT);
                $stmt->bindParam(':idContribuidorFK', $herramienta->getIdContri(), PDO::PARAM_INT);
                $stmt->execute();
                return true;
            } catch (PDOException $error) {
                error_log("Error en insert de HerramientaDAO: " . $error->getMessage());
                return false;
            }
        }

    }
?>
