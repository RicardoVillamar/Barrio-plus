<?php
//Autor: Freire Chavez Jose Andres
require_once 'model/dto/Contribucion.php';
require_once 'model/dao/ContribucionDAO.php';
require_once 'model/dao/HerramientaDAO.php';
require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dao/EstadoContribucionDAO.php';

class ContribucionController
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
            $_SESSION['mensaje'] = "No se encontraron contribuciones";
            $_SESSION['color'] = 'danger';
        }
        require_once VCONTRIBUCIONES . "list.php";
    }

    public function search()
    {
        $parametro = !empty($_POST["buscar"]) ? htmlentities($_POST["buscar"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar publicaciones por nombre herramienta o instalacion";
        if (!empty($resultados)) {
            $_SESSION['mensaje'] = "Contribuciones cargadas correctamente";
            $_SESSION['color'] = 'primary'; 
        } else {
            $_SESSION['mensaje'] = "No se encontraron contribuciones";
            $_SESSION['color'] = 'danger';
        }
        require_once VCONTRIBUCIONES . "list.php";
    }

    public function delete()
    {
        if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            if ($rol == 1){
                $id = !empty($_REQUEST["id"]) ? htmlentities($_REQUEST["id"]) : "";
                $exito = $this->model->delete($id);
                $this->redirectWithMessage(
                    $exito,
                    "Contribucion eliminada exitosamente",
                    "No se pudo realizar la eliminación",
                    "index.php?c=contribucion&f=index");
            }else if($rol != 1){
                $_SESSION["mensaje"] = "Accion no permitida para tu perfil";
                $_SESSION["color"] = "danger";
                header("Location: index.php?c=contribucion&f=index");
            }
        }
    }

    public function view_new(){
        $modeloInstalaciones = new InstalacionesDAO();
        $instalaciones = $modeloInstalaciones->selectAll("");
        $modeloHerramientas = new HerramientaDAO();
        $herramientas = $modeloHerramientas->selectAll("");
        $modeloEstadoContri = new EstadoContribucionDAO();
        $estadosContrib = $modeloEstadoContri->selectEstadoContribucion("");
        $titulo = "Nueva contribución";
        require_once VCONTRIBUCIONES . "new.php";
    }

    public function new(){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
            $_SESSION["mensaje"] = "Método no permitido";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=contribucion&f=index");
            exit;
        }
        $contribu = $this->populate();
        $exito = $this->model->insert($contribu);
        $this->redirectWithMessage($exito, "Contribucion insertada exitosamente", 
        "No se pudo realizar la inserción", "index.php?c=contribucion&f=index");
    }

    public function populate() {
        $contribu = new Contribucion();
        $contribu->setId(htmlentities($_POST['idContribucion'] ?? null));
        $contribu->setIdEstado(htmlentities($_POST['campoEstadoContr'])); 
        $contribu->setIdUsuario(htmlentities($_POST['idUsuario'])); 
        $recurso = htmlentities($_POST['recurso'] ?? null);
        if ($recurso === 'instalaciones') {
            $contribu->setIdInstalacion(htmlentities($_POST['selectInstalaciones']));
        } elseif ($recurso === 'herramientas') {
            $contribu->setIdHerramienta(htmlentities($_POST['selectHerramientas']));
        }
        return $contribu;
    }
    

    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }

    public function view_edit(){
        if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            if ($rol == 1){
                $id = htmlentities($_GET["id"]);
                $contribu= $this->model->selectOne($id);
                if($contribu == null){
                    $_SESSION["mensaje"] = "No se pudo encontrar la contribución a editar";
                    $_SESSION["color"] = "danger";
                    header("Location: index.php?c=contribucion&f=index");
                }
                $modeloInstalaciones = new InstalacionesDAO();
                $instalaciones = $modeloInstalaciones->selectAll("");
                $modeloHerramientas = new HerramientaDAO();
                $herramientas = $modeloHerramientas->selectAll("");
                $modeloEstadoContri = new EstadoContribucionDAO();
                $estadosContrib = $modeloEstadoContri->selectEstadoContribucion("");
                $titulo = "Editar contribución";
                require_once VCONTRIBUCIONES . 'edit.php';
            }else if($rol != 1){
                $_SESSION["mensaje"] = "Accion no permitida para tu perfil";
                $_SESSION["color"] = "danger";
                header("Location: index.php?c=contribucion&f=index");
            }
        }
    }

    public function edit(){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
            $_SESSION["mensaje"] = "Método no permitido";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=contribucion&f=index");
        }
        $contribu = $this->populate();
        $exito = $this->model->update($contribu);
        $this->redirectWithMessage($exito, "Contribucion actualizada exitosamente", 
        "No se pudo realizar la actualización", "index.php?c=contribucion&f=index");
    }
}
