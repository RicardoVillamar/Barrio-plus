<?php
//autor: Quiñonez Castrellón Anthony Joel
require_once 'model/dto/Herramienta.php';
require_once 'model/dao/HerramientaDAO.php';

class HerramientaController
{

    private $model;

    public function __construct()
    {
        $this->model = new HerramientaDAO();
    }

    public function index()
    {
        $resultado = $this->model->selectAll();

        $titulo = 'Herramientas';

        require_once VHERRAMIENTAS . 'list.php';
    }
}
