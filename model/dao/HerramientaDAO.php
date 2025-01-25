<!-- Autor: Freire Chavez Jose Andres -->
<?php
require_once 'config/Conexion.php';

class ContribucionDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::getConexion();
    }

    public function selectUserNames()
    {
        try {
            $sql = '
            SELECT c.idContribucion, u.nombre AS nombreUsuario
            FROM Contribucion c
            INNER JOIN Usuario u ON c.idUsuarioFK = u.idUsuario;
            ';
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            error_log('Error en obtenerContribuidoresConNombre: ' . $error->getMessage());
            return [];
        }
    }

}
