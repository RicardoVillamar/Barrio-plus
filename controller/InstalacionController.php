<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dto/Instalacion.php';
require_once 'model/dao/EstadoDAO.php';


class InstalacionController
{

    private $model, $modeloEstado;

    public function __construct()
    {
        $this->model = new InstalacionesDAO();
        $this->modeloEstado = new EstadoDAO();
    }

    public function index()
    {

        $estados = $this->modeloEstado->selectEstado();
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones';

        require_once VINSTALACIONRESERVA . 'list.php';
    }

    public function view_reservar()
    {

        $titulo = 'Reservar Instalacion';

        require_once VINSTALACIONRESERVA . 'new.php';
    }
}
