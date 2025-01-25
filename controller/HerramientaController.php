<?php
//autor: Quiñonez Castrellón Anthony Joel
require_once 'model/dto/Herramienta.php';
require_once 'model/dao/HerramientaDAO.php';
require_once 'model/dao/EstadoDAO.php';
require_once 'model/dao/ContribucionDAO.php';


class HerramientaController
{

    private $model,$modeloEstado,$modeloContri;

    public function __construct()
    {
        $this->model = new HerramientaDAO();
        $this->modeloEstado = new EstadoDAO();
        $this->modeloContri = new ContribucionDAO();

    }

    public function index(){
        $resultado = $this->model->selectAll();

        $titulo = 'Herramientas';

        require_once VHERRAMIENTAS . 'list.php';
    }

    public function index_Reserva(){
    $resultadoCompleto = $this->model->selectAll();
    $resultado = [];
    foreach ($resultadoCompleto as $row) {
        $resultado[] = [
            'idEstadoFK' => $row['idEstadoFK'],
            'nombre' => $row['nombre'],
            'imagen' => $row['imagen'],
            'descripcion' => $row['descripcion'],
            'precio' => $row['precio'],
            'idHerramienta' => $row['idHerramienta']

        ];
    }

    $estados = $this->modeloEstado->selectEstado();
    $titulo = 'Herramientas';

    require_once VHERRAMIENTASRESERVA . 'list.php';
}

    public function view_reservar()
    {
        $id = htmlentities($_GET['id']);
        
        $herramienta=$this->model->selectOne($id);

        $titulo = 'Reservar de Herramienta';

        require_once VHERRAMIENTASRESERVA  . 'new.php';
    }

    
    public function view_new(){
        $herramienta= $this->model->selectAll();
        $titulo = "Nueva herramienta";
        require_once VHERRAMIENTAS . 'new.php';
    }

    public function view_edit(){
        $id = htmlentities($_GET["id"]);
        $herramienta = $this->model->selectOne($id);
        if ($herramienta == null) {
            $this->redirectWithMessage(false, "", "No se pudo encontrar la herramienta a editar", 
            "index.php?c=herramienta&f=index");
        }
        $titulo = "Editar herramienta";
        require_once VHERRAMIENTAS . 'edit.php';
    }
    
    public function populate(){
        $herramienta = new Herramienta();
        $herramienta->setId(htmlentities($_POST['id'] ?? null));
        $herramienta->setNombre(htmlentities($_POST['nombre']));
        $herramienta->setDescrip(htmlentities($_POST['descripcion']));
        $herramienta->setPrecio(htmlentities($_POST['precio']));
        $herramienta->setImg($_FILES['imagen']['name'] ?? "");
        $herramienta->setFechaRegis(htmlentities($_POST['fechaRegistro'] ?? date("Y-m-d")));
        $herramienta->setIdEst(htmlentities($_POST['estado']));
        $herramienta->setMant(htmlentities($_POST['mantenimiento']));
        $herramienta->setCant(htmlentities($_POST['cantidad']));
        $herramienta->setIdContri(htmlentities($_POST['contribuidor']));
        return $herramienta;
    }
    
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
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
            $this->redirectWithMessage(false, "", "ID no válido o no proporcionado", 
            "index.php?c=herramienta&f=index");
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

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $herramienta = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'imagen' => null,
                'fechaRegistro' => $_POST['fechaRegistro'],
                'idEstadoFK' => $_POST['estado'],
                'mantenimiento' => $_POST['mantenimiento'],
                'cantidad' => $_POST['cantidad'],
                'idContribuidorFK' => $_POST['contribuidor'],
            ];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $herramienta['imagen'] = file_get_contents($file);
            }

            $resultado = $this->model->insert($herramienta);

            if ($resultado) {
                header('Location: index.php?c=herramienta&f=index');
            } else {
                echo "Error al registrar la instalación";
            }
        }
    }
}
?>
