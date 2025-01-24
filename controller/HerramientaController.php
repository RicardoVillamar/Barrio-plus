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

    public function search(){
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultado = $this->model->buscar($parametro);
        $titulo = "Buscar herramientas";
        require_once VHERRAMIENTAS . 'list.php';
    }
    
    public function delete(){
        $id = htmlentities($_REQUEST['id'] ?? "");

        if (empty($id) || !is_numeric($id)) {
            $this->redirectWithMessage(false, "", "ID no válido o no proporcionado", "index.php?c=herramienta&f=index");
            return;
        }
    
        $exito = $this->model->delete($id);
        $this->redirectWithMessage(
            $exito,
            "Herramienta eliminada exitosamente",
            "No se pudo realizar la eliminación. Verifica si el ID existe.",
            "index.php?c=herramienta&f=index"
        );
    }
    
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }
    
    public function view_new(){
        $titulo = "Nueva herramienta";
        require_once VHERRAMIENTAS . 'new.php';
    }
    
    public function new(){
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->redirectWithMessage(false, "", "Método no permitido", 
            "index.php?c=herramientas&f=index");
        }
        
        if (empty($_POST["nombre"]) || empty($_POST["descripcion"])) {
            $this->redirectWithMessage(false, "", "Datos incompletos", "index.php?c=herramientas&f=index");
        }
        $herramienta = $this->populate();
        $exito = $this->model->insert($herramienta);
        $this->redirectWithMessage($exito, "Herramienta insertada exitosamente", 
        "No se pudo realizar la inserción", "index.php?c=herramientas&f=index");
    }
    
    public function view_edit(){
        $id = htmlentities($_GET["id"]);
        $herramienta = $this->model->selectOne($id);
        if ($herramienta == null) {
            $this->redirectWithMessage(false, "", "No se pudo encontrar la herramienta a editar", 
            "index.php?c=herramientas&f=index");
        }
        $titulo = "Editar herramienta";
        require_once VHERRAMIENTAS . 'edit.php';
    }
    
    public function edit(){
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->redirectWithMessage(false, "", "Método no permitido", "index.php?c=herramientas&f=index");
        }
        
        if (empty($_POST["nombre"]) || empty($_POST["descripcion"])) {
            $this->redirectWithMessage(false, "", "Datos incompletos", "index.php?c=herramientas&f=index");
        }
        
        $herramienta = $this->populate();
        $exito = $this->model->update($herramienta);
        $this->redirectWithMessage($exito, "Herramienta actualizada exitosamente", 
        "No se pudo realizar la actualización", "index.php?c=herramientas&f=index");
    }
    
    public function populate(){
        $herramienta = new Herramienta();
        $herramienta->setId(htmlentities($_POST['id'] ?? null));
        $herramienta->setNombre(htmlentities($_POST['nombre']));
        $herramienta->setImg(htmlentities($_POST['imagen'] ?? ""));
        $herramienta->setDescrip(htmlentities($_POST['descripcion']));
        $herramienta->setPrecio(htmlentities($_POST['precio']));
        $herramienta->setFechaRegis(htmlentities($_POST['fechaRegistro'] ?? date("Y-m-d")));
        $herramienta->setIdEst(htmlentities($_POST['idEstadoFK']));
        $herramienta->setMant(htmlentities($_POST['mantenimiento'] ?? 0));
        $herramienta->setCant(htmlentities($_POST['cantidad']));
        $herramienta->setIdContri(htmlentities($_POST['idContribuidorFK']));
        return $herramienta;
        }
}
?>
