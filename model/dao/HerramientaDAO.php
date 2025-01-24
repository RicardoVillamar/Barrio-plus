<?php
//autor: Quiñonez Castrellón Anthony Joel -->
require_once 'config/Conexion.php';

class HerramientaDAO{
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function selectAll() {
        try {
            $sql = 'select * from herramienta';
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $error) {
            error_log('Error al obtener la herramienta' . $error->getMessage());
            return [];
        }
    } 

    // Eliminar un registro
    public function delete($id) {
        try {
            $query = "DELETE FROM herramienta WHERE idHerramienta = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en delete: " . $e->getMessage());
            return false;
        }
    }
}
?>
