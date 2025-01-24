<!--    Autor: Palacios Herdoiza Roitman Andres  -->
<?php 
require_once 'model/dto/Usuario.php';
require_once 'model/dao/UsuarioDAO.php';

class UsuarioController
{

    private $model;

    public function __construct()
    {
        $this->model = new UsuarioDAO();
    }

}

?>