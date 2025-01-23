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
            require_once 'view/estaticas/'.$page.'.php';
           
        }else{
              // flujo de ventanas
          require_once 'view/homeView.php'; 
        }
    }   
}
?>