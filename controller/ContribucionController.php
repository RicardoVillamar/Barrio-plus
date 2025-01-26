<?php
//Autor: Freire Chavez Jose Andres
require_once 'model/dto/Contribucion.php';
require_once 'model/dao/ContribucionDAO.php';
require_once 'model/dao/HerramientaDAO.php';
require_once 'model/dao/InstalacionDAO.php';

class PublicacionController
{
    private $model;

    public function __construct()
    {
        $this->model = new ContribucionDAO();
    }

    public function index()
    {
        $resultados = $this->model->selectAll("");
        $titulo = "Buscar publicaciones por nombre herramienta o instalacion";
        if (!empty($resultados)) {
            $_SESSION['mensaje'] = "Contribuciones cargadas correctamente";
            $_SESSION['color'] = 'primary'; 
        } else {
            $_SESSION['mensaje'] = "No existen contribuciones";
            $_SESSION['color'] = 'danger';
        }
        require_once VCONTRIBUCIONES . "list.php";
    }
}
