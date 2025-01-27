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
            $searchTerm = isset($_GET['search']) ? htmlentities($_GET['search']) : '';
            $reservaciones = $this->reservacionDAO->buscarReservaciones($searchTerm);
            require_once 'view/reservaciones/reservas.list.php';
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

        private function buscarReservaciones($searchTerm) {
            if (empty($searchTerm)) {
                return $this->reservacionDAO->obtenerReservaciones();
            } else {
                return $this->reservacionDAO->buscarReservaciones($searchTerm);
            }
        }
}