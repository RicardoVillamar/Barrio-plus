<?php
//Autor: Freire Chavez Jose Andres
require_once 'model/dto/Publicacion.php';
require_once 'model/dao/PublicacionDAO.php';
require_once 'model/dao/UsuarioDAO.php';
require_once 'model/dao/TipoPublicacionDAO.php';
require_once 'model/dao/PrioridadDAO.php';

class PublicacionController
{
    private $model;

    public function __construct()
    {
        $this->model = new PublicacionDAO();
    }

    public function index()
    {
        if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            $id = $usuario['idUsuario']; 
            if($rol == 1){
                $resultados = $this->model->selectAll("");
            }else if($rol != 1){
                $resultados = $this->model->selectPublicacionesById($id); 
            }
        $titulo = "Buscar publicaciones por tipo o prioridad";
        }
        if (!empty($resultados)) {
            $_SESSION['mensaje'] = "Publicaciones cargadas correctamente";
            $_SESSION['color'] = 'primary'; 
        } else {
            $_SESSION['mensaje'] = "No has realizado ninguna publicación";
            $_SESSION['color'] = 'danger';
        }
        require_once VPUBLICACIONES . "list.php";
    }

    public function search()
    {
        $parametro = !empty($_POST["buscar"]) ? $this->limpiar($_POST["buscar"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar publicaciones por tipo o prioridad";
        if (!empty($resultados)) {
            $_SESSION['mensaje'] = "Publicaciones cargadas correctamente";
            $_SESSION['color'] = 'primary'; 
        } else {
            $_SESSION['mensaje'] = "No se encontraron publicaciones";
            $_SESSION['color'] = 'danger';
        }
        require_once VPUBLICACIONES . "list.php";
    }

    public function delete()
    {
        if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            if ($rol == 1){
                $id = !empty($_REQUEST["id"]) ? $this->limpiar($_REQUEST["id"]) : "";
                $exito = $this->model->delete($id);
                $this->redirectWithMessage(
                    $exito,
                    "Publicacion eliminada exitosamente",
                    "No se pudo realizar la eliminación",
                    "index.php?c=publicacion&f=index");
            }else if($rol != 1){
                $_SESSION["mensaje"] = "Accion no permitida para tu perfil";
                $_SESSION["color"] = "danger";
                header("Location: index.php?c=publicacion&f=index");
            }
        }
    }

    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }

    public function view_new(){
        $modeloTipoPublicacion = new TipoPublicacionDAO();
        $tiposPublicaciones = $modeloTipoPublicacion->selectAll("");
        $modeloPrioridad = new PrioridadDAO();
        $prioridades = $modeloPrioridad->selectAll("");
        $titulo = "Nueva publicación";
        require_once VPUBLICACIONES . "new.php";
    }

    public function new(){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
            $_SESSION["mensaje"] = "Método no permitido";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
            exit;
        }

        //Validar campos vacios del formulario
        if(empty($_POST["nombre"]) || empty($_POST["tipo_publicacion"]) || empty($_POST["descripcion"]) 
        || empty($_POST["prioridad"]) || empty($_POST["fecha_publicacion"]) ){
            $_SESSION["mensaje"] = "Datos incompletos";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
            exit;
        }
        $publi = $this->populate();
        $exito = $this->model->insert($publi);
        $this->redirectWithMessage($exito, "Publicación insertada exitosamente", 
        "No se pudo realizar la inserción", "index.php?c=publicacion&f=index");
    }

    public function populate(){
        if (empty($_POST["nombre"]) || empty($_POST["tipo_publicacion"]) || empty($_POST["descripcion"]) 
        || empty($_POST["prioridad"]) || empty($_POST["fecha_publicacion"])) {
            $_SESSION["mensaje"] = "Datos incompletos";
            $_SESSION["color"] = "danger";
        header("Location: index.php?c=publicacion&f=index");
        exit;
        }

        $publi = new Publicacion();
        $publi->setId($this->limpiar($_POST['id']??null));
        $publi->setTitulo($this->limpiar($_POST['nombre']));

        if (!is_numeric($_POST["tipo_publicacion"])) {
            $_SESSION["mensaje"] = "El id del tipo de publicación no es válido.";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
            exit;
        }

        $publi->setIdTipo($this->limpiar($_POST['tipo_publicacion']));
        $publi->setDescripcion($this->limpiar($_POST['descripcion']));

        if (!is_numeric($_POST["prioridad"])) {
            $_SESSION["mensaje"] = "El id de la prioridad no es válida.";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
            exit;
        }
        
        $publi->setIdPrioridad($this->limpiar($_POST['prioridad']));
        $publi->setFechaEvento($this->limpiar($_POST['fecha_publicacion']));

        if (!is_numeric($_POST["idUsuario"])) {
            $_SESSION["mensaje"] = "El id del usuario no es válido.";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
            exit;
        }
        $publi->setIdUsuario($this->limpiar($_POST['idUsuario']));
        $notificarAdm = $this->limpiar(isset($_POST['notificarSoloAdmins'])?1:0); 
        $publi->setNotificarAdmin($notificarAdm);
        return $publi;
    }

    public function view_edit(){
        if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            if ($rol == 1){
                $id = $this->limpiar($_GET["id"]);
                $publi = $this->model->selectOne($id);
                if($publi==null){
                    $_SESSION["mensaje"] = "No se pudo encontrar la publicación a editar";
                    $_SESSION["color"] = "danger";
                    header("Location: index.php?c=publicacion&f=index");
                }
                $modeloTipoPublicacion = new TipoPublicacionDAO();
                $tiposPublicaciones = $modeloTipoPublicacion->selectAll("");
                $modeloPrioridad = new PrioridadDAO();
                $prioridades = $modeloPrioridad->selectAll("");
                $titulo = "Editar publicación";
                require_once VPUBLICACIONES . 'edit.php';
            }else if($rol != 1){
                $_SESSION["mensaje"] = "Accion no permitida para tu perfil";
                $_SESSION["color"] = "danger";
                header("Location: index.php?c=publicacion&f=index");
            }
        }
    }

    public function edit(){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
            $_SESSION["mensaje"] = "Método no permitido";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
        }
        //Validar campos del formulario
        if(empty($_POST["nombre"]) || empty($_POST["tipo_publicacion"]) || empty($_POST["descripcion"]) 
        || empty($_POST["prioridad"]) || empty($_POST["fecha_publicacion"]) ){
            $_SESSION["mensaje"] = "Datos incompletos";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
        }
        $publi = $this->populate();
        $exito = $this->model->update($publi);
        $this->redirectWithMessage($exito, "Publicacion actualizada exitosamente", 
        "No se pudo realizar la actualización", "index.php?c=publicacion&f=index");
    }

    public function limpiar($dato){
        $dato = trim($dato);
        $dato = stripcslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
}
