<!-- Autor: Freire Chavez Jose Andres -->
<?php
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
        
        $resultados = $this->model->selectAll("");
        $titulo = "Buscar publicaciones";
        require_once VPUBLICACIONES . "list.php";
        if (count($resultados) > 0) {
            echo "Publicaciones cargadas correctamente";
        } else {
            echo "No se encontraron publicaciones";
        }
    }

    public function search()
    {
        $parametro = !empty($_POST["buscar"]) ? htmlentities($_POST["buscar"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar publicaciones por tipo o prioridad";
        require_once VPUBLICACIONES . "list.php";
        if (count($resultados) > 0) {
            echo "Publicaciones cargadas correctamente";
        } else {
            echo "No se encontraron publicaciones";
        }
    }

    public function delete()
    {
        $id = !empty($_REQUEST["id"]) ? htmlentities($_REQUEST["id"]) : "";
        $exito = $this->model->delete($id);
        $this->redirectWithMessage(
            $exito,
            "Publicacion eliminada exitosamente",
            "No se pudo realizar la eliminación",
            "index.php?c=publicacion&f=index"
        );
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
        }
        //Validar campos del formulario
        if(empty($_POST["nombre"]) || empty($_POST["tipo_publicacion"]) || empty($_POST["descripcion"]) 
        || empty($_POST["prioridad"]) || empty($_POST["fecha_publicacion"]) ){
            $_SESSION["mensaje"] = "Datos incompletos";
            $_SESSION["color"] = "danger";
            header("Location: index.php?c=publicacion&f=index");
        }
        $publi = $this->populate();
        $exito = $this->$model->insert($publi);
        $this->redirectWithMessage($exito, "Publicación insertada exitosamente", 
        "No se pudo realizar la inserción", "index.php?c=publicacion&f=index");
    }

    public function populate(){
        //Lectura de parametros
        $publi = new Publicacion();
        $publi->setId(htmlentities($_POST['id']??null));
        $publi->setTitulo(htmlentities($_POST['nombre']));
        $publi->setIdTipo(htmlentities($_POST['tipo_publicacion']));
        $publi->setDescripcion(htmlentities($_POST['descripcion']));
        $publi->setIdPrioridad(htmlentities($_POST['prioridad']));
        $publi->setFechaEvento(htmlentities($_POST['fecha_publicacion']));
        $notificarAdm = isset($_POST['notificarSoloAdmins'])?1:0; 
        $publi->setNotificarAdmin($notificarAdm);
        //$publi->setIdUsuario(htmlentities($_SESSION["usuario"] ));
        return $publi;
    }

    public function view_edit(){
        if(!isset($_SESSION)){ session_start();}
        if(isset($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
            $rol = $usuario['idRolFK']; 
            if ($rol == 1){
                $id = htmlentities($_GET["id"]);
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
                echo "Acción no permitida para tu perfil";
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
        $exito = $this->$model->update($publi);
        $this->redirectWithMessage($exito, "Publicacion actualizada exitosamente", 
        "No se pudo realizar la actualización", "index.php?c=publicacion&f=index");
    }
}
