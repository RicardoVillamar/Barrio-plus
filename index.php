<?php
    //FrontController
    require_once 'config/Config.php';
    $controlador = (!empty($_REQUEST['c']))?htmlentities($_REQUEST['c']):CONTROLADOR_PRINCIPAL;
    $controlador = ucwords(strtolower($controlador))."Controller";

    $funcion = (!empty($_REQUEST['f']))?htmlentities($_REQUEST['f']):FUNCION_PRINCIPAL;
    
    require_once 'controller/' . $controlador . '.php';
    
    $cont = new  $controlador();
    $cont->$funcion();
?>