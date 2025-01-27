<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
require_once 'model/dao/ReservacionDAO.php';
require_once 'model/dto/Reservacion.php';

class ReservacionController
{    
        private $reservacionDAO;
    
        public function __construct() {
            $this->reservacionDAO = new ReservacionDAO();
        }
    
        public function index() {
            $reservaciones = $this->reservacionDAO->obtenerReservaciones();
            require_once 'view/reservaciones/reservas.list.php';
        }
    
        public function aprobar() {
            $idReservacion = $_GET['id'];
            $tipoElemento = $_GET['tipo'];
            $this->reservacionDAO->actualizarEstado($idReservacion, 2, $tipoElemento); // 2 = Aprobado
            header('Location: index.php?c=reservacion&f=gestionar');
        }
    
        public function cancelar() {
            $idReservacion = $_GET['id'];
            $tipoElemento = $_GET['tipo'];
            $this->reservacionDAO->actualizarEstado($idReservacion, 3, $tipoElemento); // 3 = Cancelado
            header('Location: index.php?c=reservacion&f=gestionar');
        }

        public function gestionar() {
            if (isset($_GET['id'], $_GET['tipo'], $_GET['accion'])) {
                $id = htmlentities($_GET['id']);
                $tipo = htmlentities($_GET['tipo']);
                $accion = htmlentities($_GET['accion']);
                
                $estadoMap = [
                    'aprobar' => 2, 
                    'cancelar' => 3  
                ];
                
                if (isset($estadoMap[$accion])) {
                    $nuevoEstado = $estadoMap[$accion];
                    
                    if ($this->reservacionDAO->actualizarEstado($id, $nuevoEstado, $tipo)) {
                        header('Location: index.php?c=reservacion&f=index');
                        exit;
                    } else {
                        echo "Error al gestionar la reservación.";
                    }
                } else {
                    echo "Acción inválida.";
                }
            } else {
                echo "Parámetros de gestión faltantes.";
            }
        }
}