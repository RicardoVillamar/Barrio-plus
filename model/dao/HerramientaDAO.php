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
            $sql = 'select * from herramienta';
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
            $sql = "SELECT * FROM herramienta WHERE idHerramienta = :id";
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

    public function insert($herramienta) {
        try {
            $query = "INSERT INTO herramienta (nombre, imagen, descripcion, precio, fechaRegistro, idEstadoFK, mantenimiento, cantidad, idContribuidorFK) 
                      VALUES (:nombre, :imagen, :descripcion, :precio, :fechaRegistro, :idEstadoFK, :mantenimiento, :cantidad, :idContribuidorFK)";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':nombre', $herramienta->getNombre());
            $stmt->bindParam(':imagen', $herramienta->getImg());
            $stmt->bindParam(':descripcion', $herramienta->getDescrip());
            $stmt->bindParam(':precio', $herramienta->getPrecio());
            $stmt->bindParam(':fechaRegistro', $herramienta->getFechaRegis());
            $stmt->bindParam(':idEstadoFK', $herramienta->getIdEst(), PDO::PARAM_INT);
            $stmt->bindParam(':mantenimiento', $herramienta->getMant());
            $stmt->bindParam(':cantidad', $herramienta->getCant());
            $stmt->bindParam(':idContribuidorFK', $herramienta->getIdContri(), PDO::PARAM_INT);
            $stmt->execute();

            return $this->con->lastInsertId();
        } catch (Exception $e) {
            error_log("Error en insert: " . $e->getMessage());
            return false;
        }
    }

    public function update($herramienta) {
        try {
            $query = "UPDATE herramienta 
                      SET nombre = :nombre, imagen = :imagen, descripcion = :descripcion, 
                          precio = :precio, fechaRegistro = :fechaRegistro, idEstadoFK = :idEstadoFK, 
                          mantenimiento = :mantenimiento, cantidad = :cantidad, idContribuidorFK = :idContribuidorFK
                      WHERE idHerramienta = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $herramienta->getId(), PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $herramienta->getNombre());
            $stmt->bindParam(':imagen', $herramienta->getImg());
            $stmt->bindParam(':descripcion', $herramienta->getDescrip());
            $stmt->bindParam(':precio', $herramienta->getPrecio());
            $stmt->bindParam(':fechaRegistro', $herramienta->getFechaRegis());
            $stmt->bindParam(':idEstadoFK', $herramienta->getIdEst());
            $stmt->bindParam(':mantenimiento', $herramienta->getMant());
            $stmt->bindParam(':cantidad', $herramienta->getCant());
            $stmt->bindParam(':idContribuidorFK', $herramienta->getIdContri());
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en update: " . $e->getMessage());
            return false;
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
}
?>
