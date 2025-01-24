<!-- Autor: Villamar Minuche Ricardo Daniel -->

<?php

require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dto/Instalacion.php';


class InstalacionController
{

    private $model;

    public function __construct()
    {
        $this->model = new InstalacionesDAO();
    }

    public function index()
    {
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones';

        require_once VINSTALACIONES . 'list.php';
    }
}


?>