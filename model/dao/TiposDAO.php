<?php
//autor: Villamar Minuche Ricardo Daniel
require_once 'config/Conexion.php';

class TiposDAO
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function getTipos()
    {
        try {
            $sql = 'select * from Tipo';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectAll de TiposDAO ' . $error->getMessage());
            return [];
        }
    }
}
