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
                        e.nombre AS estado_nombre,      
                        u.nombre AS contribuidor_nombre 
                        FROM Instalacion i JOIN Tipo t ON i.idTipoFK = t.idTipo JOIN Estado e ON i.idEstadoFK = e.idEstado JOIN Usuario u ON i.idContribuidorFK = u.idUsuario;';
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
                        e.nombre AS estado_nombre,      
                        u.nombre AS contribuidor_nombre 
                        from Instalacion i
                        JOIN Tipo t ON i.idTipoFK = t.idTipo
                        JOIN Estado e ON i.idEstadoFK = e.idEstado
                        JOIN Usuario u ON i.idContribuidorFK = u.idUsuario
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
}
