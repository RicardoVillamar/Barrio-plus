<?php
//Autor: Quiñonez Castrellón Anthony Joel
require_once 'config/Conexion.php';
class HerramientaDAO
{

    private $cone;

    public function __construct()
    {
        $this->cone = Conexion::getConexion();
    }

    public function selectAll()
    {
        try {
            $sql = 'SELECT 
            h.idHerramienta, 
            h.nombre, 
            h.descripcion, 
            h.precio, 
            h.imagen, 
            h.fechaRegistro,
            e.nombre AS estado_nombre,
            h.mantenimiento,
            h.cantidad
            FROM herramienta h 
            JOIN Estado e ON h.idEstadoFK = e.idEstado';

            $stmt = $this->cone->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error en selectAll de HerramientaDAO ' . $error->getMessage());
            return [];
        }
    }

    public function selectOne($id)
    {
        try {
            $sql = 'SELECT 
            h.idHerramienta, 
            h.nombre, 
            h.descripcion, 
            h.precio, 
            h.imagen, 
            h.fechaRegistro,
            e.nombre AS estado_nombre,
            h.mantenimiento,
            h.cantidad
            FROM herramienta h 
            JOIN Estado e ON h.idEstadoFK = e.idEstado
            WHERE h.idHerramienta = :id';

            $stmt = $this->cone->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $respuesta = $stmt->fetch(PDO::FETCH_ASSOC);
            return $respuesta ?: null;
        } catch (PDOException $error) {
            error_log('Error en selectOne de HerramientaDAO: ' . $error->getMessage());
            return null;
        }
    }

    //Insertar Herramienta
    public function insert($herramienta)
    {
        try {
            $sql = 'insert into herramienta (nombre, descripcion, precio, imagen, fechaRegistro, idEstadoFK, mantenimiento, cantidad) 
            values (:nombre, :descripcion, :precio, :imagen, :fechaRegistro, :idEstadoFK, :mantenimiento, :cantidad)';
    
            $stmt = $this->cone->prepare($sql);
            $stmt->bindParam(':nombre', $herramienta['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $herramienta['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $herramienta['precio'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $herramienta['imagen'], PDO::PARAM_LOB);
            $stmt->bindParam(':fechaRegistro', $herramienta['fechaRegistro'], PDO::PARAM_STR);
            $stmt->bindParam(':idEstadoFK', $herramienta['idEstadoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':mantenimiento', $herramienta['mantenimiento'], PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $herramienta['cantidad'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $error) {
            error_log("Error en insert de HerramientaDAO" . $error->getMessage());
            return false;
        }
    }

    //Editar Herramienta
    public function update($id, $herramienta)
    {
        try {

            $sql = 'update herramienta set nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen, 
            fechaRegistro = :fechaRegistro, idEstadoFK = :idEstadoFK, mantenimiento = :mantenimiento, cantidad = :cantidad 
            where idHerramienta = :id';

            $stmt = $this->cone->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $herramienta['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $herramienta['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $herramienta['precio'], PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $herramienta['imagen'], PDO::PARAM_LOB);
            $stmt->bindParam(':fechaRegistro', $herramienta['fechaRegistro'], PDO::PARAM_STR);
            $stmt->bindParam(':idEstadoFK', $herramienta['idEstadoFK'], PDO::PARAM_INT);
            $stmt->bindParam(':mantenimiento', $herramienta['mantenimiento'], PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $herramienta['cantidad'], PDO::PARAM_INT);

            $respuesta = $stmt->execute();
            return $respuesta;
        } catch (PDOException $error) {
            error_log("Error en update de HerramientaDAO" . $error->getMessage());
            return false;
        }
    }

    //Elimina Herramienta
    public function delete($id)
    {
        try {
            $sql = 'delete from herramienta where idHerramienta = :id';
            $stmt = $this->cone->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $respuesta = $stmt->execute();
            return $respuesta;
        } catch (PDOException $error) {
            error_log("Error en delete de HerramientaDAO" . $error->getMessage());
            return false;
        }
    }

    //Buscar Herramienta
    public function buscar($nombre = "") {
        try {
            if (!empty($nombre)) {
                $sql = 'SELECT 
                            h.idHerramienta, 
                            h.nombre, 
                            h.descripcion, 
                            h.precio, 
                            h.imagen, 
                            h.fechaRegistro,
                            e.nombre AS estado_nombre,
                            h.mantenimiento,
                            h.cantidad
                        FROM herramienta h 
                        JOIN Estado e ON h.idEstadoFK = e.idEstado
                        WHERE h.nombre LIKE :nombre';
                $stmt = $this->cone->prepare($sql);
                $nombre = "%" . $nombre . "%";
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            } else {
                $sql = 'SELECT 
                            h.idHerramienta, 
                            h.nombre, 
                            h.descripcion, 
                            h.precio, 
                            h.imagen, 
                            h.fechaRegistro,
                            e.nombre AS estado_nombre,
                            h.mantenimiento,
                            h.cantidad
                        FROM herramienta h 
                        JOIN Estado e ON h.idEstadoFK = e.idEstado';
                $stmt = $this->cone->prepare($sql);
            }
    
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error al obtener las herramientas: ' . $error->getMessage());
            return [];
        }
    }

    //Insertar una nueva Reserva
    public function insert_Reserva($reserva){
    try {
        $sql = 'INSERT INTO ReservacionHerramienta 
                (idEstadoFK, idHerramientaFK, idUsuarioFK, cantidad, fechaInicio, fechaFin, proposito, capacitacion) 
                VALUES 
                (:idEstadoFK, :idHerramientaFK, :idUsuarioFK, :cantidad, :fechaInicio, :fechaFin, :proposito, :capacitacion)';

        $stmt = $this->cone->prepare($sql);
        $stmt->bindParam(':idEstadoFK', $reserva['idEstadofK'], PDO::PARAM_STR);
        $stmt->bindParam(':idHerramientaFK', $reserva['idHerramientaFK'], PDO::PARAM_INT);
        $stmt->bindParam(':idUsuarioFK', $reserva['idUsuarioFK'], PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $reserva['cantidad'], PDO::PARAM_INT);
        $stmt->bindParam(':fechaInicio', $reserva['fechaInicio'], PDO::PARAM_STR);
        $stmt->bindParam(':fechaFin', $reserva['fechaFin'], PDO::PARAM_STR);
        $stmt->bindParam(':proposito', $reserva['proposito'], PDO::PARAM_STR);
        $stmt->bindParam(':capacitacion', $reserva['capacitacion'], PDO::PARAM_BOOL);

        return $stmt->execute();
    } catch (PDOException $error) {
        error_log("Error al insertar la reserva en HerramientaDAO: " . $error->getMessage());
        return false;
    }
}
  
}
