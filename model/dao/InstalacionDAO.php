<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once 'config/Conexion.php';

class InstalacionesDAO
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function selectAll()
    {
        try {
            $sql = 'select 
            i.idInstalacion, 
            i.nombre AS nombre_instalacion, 
            i.descripcion, 
            i.precio, 
            i.tamano,
            i.imagen, 
            t.nombre AS tipo_nombre,         
            e.nombre AS estado_nombre
            FROM Instalacion i 
            JOIN Tipo t ON i.idTipoFK = t.idTipo 
            JOIN Estado e ON i.idEstadoFK = e.idEstado';

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectAll de InstalacionesDAO ' . $error->getMessage());
            return [];
        }
    }

    public function selectOne($id)
    {
        try {
            $sql = 'select 
            i.idInstalacion, 
            i.nombre, 
            i.descripcion, 
            i.precio, 
            i.tamano,
            i.imagen, 
            t.nombre AS tipo_nombre,         
            e.nombre AS estado_nombre
            FROM Instalacion i
            JOIN Tipo t ON i.idTipoFK = t.idTipo
            JOIN Estado e ON i.idEstadoFK = e.idEstado
            WHERE 
            i.idInstalacion = :id';

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta ?: null;
        } catch (PDOException $error) {
            error_log('Error en selectOne de InstalacionesDAO: ' . $error->getMessage());
            return null;
        }
    }



    public function insert($instalacion)
    {
        try {

            $sql = 'insert into Instalacion (nombre, descripcion, precio, tamano, idTipoFK, idEstadoFK, imagen) values (:nombre, :descripcion, :precio, :tamano, :idTipoFK, :idEstadoFK, :imagen)';

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $instalacion['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $instalacion['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $instalacion['precio'], PDO::PARAM_INT);
            $stmt->bindParam(':tamano', $instalacion['tamano'], PDO::PARAM_STR);
            $stmt->bindParam(':idTipoFK', $instalacion['idTipoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':idEstadoFK', $instalacion['idEstadoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $instalacion['imagen'], PDO::PARAM_LOB);
            $respuesta = $stmt->execute();
            return $respuesta;
        } catch (PDOException $error) {
            error_log("Error en insert de InstalacionDAO" . $error->getMessage());
            return false;
        }
    }

    public function update($id, $instalacion)
    {
        try {

            $sql = 'update Instalacion set nombre = :nombre, descripcion = :descripcion, precio = :precio, tamano = :tamano, idTipoFK = :idTipoFK, idEstadoFK = :idEstadoFK, imagen = :imagen where idInstalacion = :id';

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $instalacion['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $instalacion['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $instalacion['precio'], PDO::PARAM_INT);
            $stmt->bindParam(':tamano', $instalacion['tamano'], PDO::PARAM_STR);
            $stmt->bindParam(':idTipoFK', $instalacion['idTipoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':idEstadoFK', $instalacion['idEstadoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $instalacion['imagen'], PDO::PARAM_LOB);

            $respuesta = $stmt->execute();
            return $respuesta;
        } catch (PDOException $error) {
            error_log("Error en update de InstalacionDAO" . $error->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = 'delete from Instalacion where idInstalacion = :id';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $respuesta = $stmt->execute();
            return $respuesta;
        } catch (PDOException $error) {
            error_log("Error en delete de InstalacionDAO" . $error->getMessage());
            return false;
        }
    }
}
