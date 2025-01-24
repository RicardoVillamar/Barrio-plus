<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
require_once 'config/Conexion.php';

class ReservacionDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::getConexion();
    }

    public function listarReservaciones()
    {
        $sql = "SELECT 
                    r.idReservacion, 
                    CASE 
                        WHEN r.idHerramientaFK IS NOT NULL THEN h.nombre 
                        WHEN r.idInstalacionFK IS NOT NULL THEN i.nombre 
                        ELSE 'Desconocido' 
                    END AS recurso, 
                    CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                    CASE 
                        WHEN r.idHerramientaFK IS NOT NULL THEN 'Herramienta'
                        WHEN r.idInstalacionFK IS NOT NULL THEN 'Instalación'
                    END AS tipo,
                    CASE 
                        WHEN r.idHerramientaFK IS NOT NULL THEN CONCAT(r.cantidad, ' unidades')
                        WHEN r.idInstalacionFK IS NOT NULL THEN CONCAT(r.personasEsperadas, ' personas')
                    END AS detalle,
                    r.fechaInicio, 
                    r.fechaFin, 
                    r.estado
                FROM (
                    SELECT idReservacion, idHerramientaFK, idUsuarioFK, cantidad, NULL AS idInstalacionFK, NULL AS personasEsperadas, fechaInicio, fechaFin, estado 
                    FROM ReservacionHerramienta
                    UNION ALL
                    SELECT idReservacion, NULL AS idHerramientaFK, idUsuarioFK, NULL AS cantidad, idInstalacionFK, personasEsperadas, fechaInicio, fechaFin, estado
                    FROM ReservacionInstalacion
                ) r
                LEFT JOIN Herramienta h ON r.idHerramientaFK = h.idHerramienta
                LEFT JOIN Instalacion i ON r.idInstalacionFK = i.idInstalacion
                JOIN Usuario u ON r.idUsuarioFK = u.idUsuario";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($idReservacion, $nuevoEstado)
    {
        $sqlHerramienta = "UPDATE ReservacionHerramienta SET estado = :estado WHERE idReservacion = :id";
        $sqlInstalacion = "UPDATE ReservacionInstalacion SET estado = :estado WHERE idReservacion = :id";

        $stmtHerramienta = $this->conexion->prepare($sqlHerramienta);
        $stmtInstalacion = $this->conexion->prepare($sqlInstalacion);

        $stmtHerramienta->bindParam(':estado', $nuevoEstado);
        $stmtHerramienta->bindParam(':id', $idReservacion);

        $stmtInstalacion->bindParam(':estado', $nuevoEstado);
        $stmtInstalacion->bindParam(':id', $idReservacion);

        $stmtHerramienta->execute();
        $stmtInstalacion->execute();
    }
}
?>