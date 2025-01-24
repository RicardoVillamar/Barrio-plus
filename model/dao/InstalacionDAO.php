<!-- Autor: Villamar Minuche Ricardo Daniel -->

<?php
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
            $sql = 'select * from instalacion';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectAll de InstalacionesDAO ' . $error->getMessage());
            return [];
        }
    }
}


?>