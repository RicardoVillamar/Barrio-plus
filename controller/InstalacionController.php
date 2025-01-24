<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dto/Instalacion.php';
require_once 'model/dao/EstadoDAO.php';
require_once 'model/dao/TiposDAO.php';


class InstalacionController
{

    private $model, $modeloEstado, $modeloTipo;

    public function __construct()
    {
        $this->model = new InstalacionesDAO();
        $this->modeloEstado = new EstadoDAO();
        $this->modeloTipo = new TiposDAO();
    }

    public function index()
    {

        $estados = $this->modeloEstado->selectEstado();
        $tipos = $this->modeloTipo->getTipos();
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones';

        require_once VINSTALACIONRESERVA . 'list.php';
    }

    public function view_reservar()
    {
        $id = htmlentities($_GET['id']);
        $instalacion = $this->model->selectOne($id);

        $resultados = $this->model->selectAll();

        $titulo = 'Reservar Instalacion';

        require_once VINSTALACIONRESERVA . 'new.php';
    }

    public function index_instalacion()
    {
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones registradas';

        require_once VINSTALACION . 'list.php';
    }


    public function view_editar()
    {
        $resultados = $this->model->selectAll();

        $titulo = 'Editar Instalacion';

        require_once VINSTALACION . 'edit.php';
    }

    public function new_instalacion()
    {
        $titulo = 'Registrar Instalacion';
        require_once VINSTALACION . 'new.php';
    }
}
