<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
require_once 'config/Conexion.php';
require_once 'model/dto/Reservacion.php';

class ReservacionDAO
{
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function obtenerReservaciones() {
        try {
            $sql = "SELECT r.idReservacion, r.idEstadoFK, r.idHerramientaFK AS idElementoFK, 'Herramienta' AS tipoElemento, 
               r.idUsuarioFK, r.cantidad, r.fechaInicio, r.fechaFin, r.proposito, r.capacitacion, 
               NULL AS personasEsperadas, NULL AS observaciones,
               h.nombre AS nombreElemento, CONCAT(u.nombre, ' ', u.apellido) AS nombreUsuario
        FROM ReservacionHerramienta r
        JOIN Herramienta h ON r.idHerramientaFK = h.idHerramienta
        JOIN Usuario u ON r.idUsuarioFK = u.idUsuario
        UNION
        SELECT r.idReservacion, r.idEstadoFK, r.idInstalacionFK AS idElementoFK, 'Instalación' AS tipoElemento, 
               r.idUsuarioFK, NULL AS cantidad, r.fechaInicio, r.fechaFin, r.proposito, NULL AS capacitacion, 
               r.personasEsperadas, r.observaciones,
               i.nombre AS nombreElemento, CONCAT(u.nombre, ' ', u.apellido) AS nombreUsuario
        FROM ReservacionInstalacion r
        JOIN Instalacion i ON r.idInstalacionFK = i.idInstalacion
        JOIN Usuario u ON r.idUsuarioFK = u.idUsuario"; // your existing SQL statement
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $reservaciones = [];
        foreach ($result as $row) {
            $reservacion = new Reservacion(
                $row['idReservacion'],
                $row['idEstadoFK'],
                $row['idElementoFK'],
                $row['tipoElemento'],
                $row['idUsuarioFK'],
                $row['cantidad'],
                $row['fechaInicio'],
                $row['fechaFin'],
                $row['proposito'],
                $row['capacitacion'],
                $row['personasEsperadas'],
                $row['observaciones']
            );
            $reservacion->setNombreElemento($row['nombreElemento']); 
            $reservacion->setNombreUsuario($row['nombreUsuario']); 
            $reservaciones[] = $reservacion;
        }
        return $reservaciones;
        } catch(PDOException $e) {            
            error_log("Error al obtener reservaciones: " . $e->getMessage());
            return []; 
        }
    }

    public function actualizarEstado($idReservacion, $nuevoEstado, $tipoElemento) {
        try {
            $tabla = ($tipoElemento === 'Herramienta') ? 'ReservacionHerramienta' : 'ReservacionInstalacion';
            $sql = "UPDATE $tabla SET idEstadoFK = :nuevoEstado WHERE idReservacion = :idReservacion";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nuevoEstado', $nuevoEstado);
            $stmt->bindParam(':idReservacion', $idReservacion);
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error al actualizar estado de reservación: " . $e->getMessage());
            return false;
        }
    }

    public function buscarReservaciones($searchTerm) {
        $sql = "
        SELECT r.idReservacion, r.idEstadoFK, r.idHerramientaFK AS idElementoFK, 'Herramienta' AS tipoElemento, 
               r.idUsuarioFK, r.cantidad, r.fechaInicio, r.fechaFin, r.proposito, r.capacitacion, 
               NULL AS personasEsperadas, NULL AS observaciones,
               h.nombre AS nombreElemento, CONCAT(u.nombre, ' ', u.apellido) AS nombreUsuario
        FROM ReservacionHerramienta r
        JOIN Herramienta h ON r.idHerramientaFK = h.idHerramienta
        JOIN Usuario u ON r.idUsuarioFK = u.idUsuario
        WHERE h.nombre LIKE :searchTerm OR CONCAT(u.nombre, ' ', u.apellido) LIKE :searchTerm
        UNION
        SELECT r.idReservacion, r.idEstadoFK, r.idInstalacionFK AS idElementoFK, 'Instalación' AS tipoElemento, 
               r.idUsuarioFK, NULL AS cantidad, r.fechaInicio, r.fechaFin, r.proposito, NULL AS capacitacion, 
               r.personasEsperadas, r.observaciones,
               i.nombre AS nombreElemento, CONCAT(u.nombre, ' ', u.apellido) AS nombreUsuario
        FROM ReservacionInstalacion r
        JOIN Instalacion i ON r.idInstalacionFK = i.idInstalacion
        JOIN Usuario u ON r.idUsuarioFK = u.idUsuario
        WHERE i.nombre LIKE :searchTerm OR CONCAT(u.nombre, ' ', u.apellido) LIKE :searchTerm";

        $stmt = $this->conexion->prepare($sql);
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $reservaciones = [];
        foreach ($result as $row) {
            $reservaciones[] = new Reservacion(
                $row['idReservacion'],
                $row['idEstadoFK'],
                $row['idElementoFK'],
                $row['tipoElemento'],
                $row['idUsuarioFK'],
                $row['cantidad'],
                $row['fechaInicio'],
                $row['fechaFin'],
                $row['proposito'],
                $row['capacitacion'],
                $row['personasEsperadas'],
                $row['observaciones']
            );
            
            $reservaciones[count($reservaciones) - 1]->setNombreElemento($row['nombreElemento']);
            $reservaciones[count($reservaciones) - 1]->setNombreUsuario($row['nombreUsuario']);
        }
        return $reservaciones;
    }
}
?>