<!-- Autor: Freire Chavez Jose Andres -->
<?php
require_once 'config/Conexion.php';

class TipoPublicacionDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectAll($parametro)
    {
        try {
            $sql = "select * from tipopublicacion";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en selectAll de TipoPublicacionDAO " . $er->getMessage());
            return [];
        }
    }
}
?>