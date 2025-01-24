<?php
//autor: Villamar Minuche Ricardo Daniel
require_once 'config/Conexion.php';

class EstadoDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function selectEstado()
    {
        try {
            $sql = 'select * from Estado';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectEstado de InstalacionesDAO ' . $error->getMessage());
            return [];
        }
    }
}
