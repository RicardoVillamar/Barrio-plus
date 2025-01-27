<?php
//Autor: Freire Chavez Jose Andres

require_once 'config/Conexion.php';

class EstadoContribucionDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function selectEstadoContribucion()
    {
        try {
            $sql = 'select * from estadocontribucion';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectEstadoContribucion de EstadoContribucionDAO ' . $error->getMessage());
            return [];
        }
    }
}


?>