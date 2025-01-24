<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
require_once 'model/dao/ReservacionDAO.php';
require_once 'model/dto/Reservacion.php';

class ReservacionController
{
    private $reservacionDAO;

    public function __construct()
    {
        $this->reservacionDAO = new ReservacionDAO();
    }

    public function listar()
    {
        $reservaciones = $this->reservacionDAO->listarReservaciones();
        require_once 'view/reservaciones/reservas.list.php';
    }

    public function aprobar()
    {
        $idReservacion = $_POST['idReservacion'];
        $this->reservacionDAO->actualizarEstado($idReservacion, 'Aprobada');
        header('Location: index.php?c=reservaciones&f=index');
    }

    public function cancelar()
    {
        $idReservacion = $_POST['idReservacion'];
        $this->reservacionDAO->actualizarEstado($idReservacion, 'Cancelada');
        header('Location: index.php?c=reservaciones&f=index');
    }
}