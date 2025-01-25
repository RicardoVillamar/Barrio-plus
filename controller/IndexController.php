<?php
function limpiar($dato)
{
    $dato = trim($dato);
    $dato = stripcslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

class IndexController {  
    public function index(){
        if(!empty($_GET['p'])){
            $page =  limpiar($_GET['p']); // limpiar datos
            // flujo de ventanas
            require_once 'view/static/'.$page.'.php';
        }else if(!isset($_SESSION['usuario'])){
            require_once 'view/usuario/Login.php'; 
        }else if(!empty($_GET['ho'])){
            require_once 'model/dao/PublicacionDAO.php';
            $modeloPublicaciones = new PublicacionDAO();
            $publicaciones = $modeloPublicaciones->selectAll("");
            // flujo de ventanas
            require_once 'view/homeView.php'; 
        }
    }   
}
?>