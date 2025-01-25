<?php
//Autor: Quiñonez Castrellón Anthony Joel
require_once 'model/dao/HerramientaDAO.php';
require_once 'model/dto/Herramienta.php';
require_once 'model/dao/EstadoDAO.php';
require_once 'model/dao/UsuarioDAO.php';


class HerramientaController
{

    private $model, $modeloEstado, $modeloUsuario;

    public function __construct()
    {
        $this->model = new HerramientaDAO();
        $this->modeloEstado = new EstadoDAO();
    }

    //Pagina principal de herramienta
    public function index(){

        $estados = $this->modeloEstado->selectEstado();
        $resultado = $this->model->selectAll();

        $titulo = 'Herramienta';

        require_once VHERRAMIENTAS . 'list.php';
    }

    //Pagina de reserva de herramienta
    public function view_reservar(){
        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);

        $titulo = 'Reservar de Herramienta';

        require_once VHERRAMIENTASRESERVA . 'new.php';
    }

    //Pagina prin de herramienta
    public function index_Herramienta(){
        $resultado = $this->model->selectAll();

        $titulo = 'Herramienta registradas';

        require_once VHERRAMIENTASRESERVA . 'list.php';
    }

    //Eliminar herramienta
    public function view_eliminar(){
        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->delete($id);
        $titulo = 'Eliminar Instalacion';
        header("Location: index.php?c=herramienta&f=index");
    }

    //Editar herramienta
    public function view_editar(){
        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);
        
        if (!$herramienta) {
            echo "Error: La herramienta no existe.";
            exit;
        }
        
        $estados = $this->modeloEstado->selectEstado();
        
        $titulo = 'Editar Instalacion';
        require_once VHERRAMIENTAS . 'edit.php';
    }
    
    //Registrar Herramienta
    public function new_Herramienta(){
        $estados = $this->modeloEstado->selectEstado();

        $titulo = 'Registrar Herramienta';
        require_once VHERRAMIENTAS . 'new.php';
    }

    //Insertar Herramientas
    public function insert(){
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
            ];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($file);
                if (strpos($mime, 'image/') === 0) {
                    $herramienta['imagen'] = file_get_contents($file);
                } else {
                    echo "El archivo cargado no es una imagen válida.";
                    return;
                }
            }

            $resultado = $this->model->insert($herramienta);

            if ($resultado) {
                header('Location: index.php?c=herramienta&f=index');
            } else {
                echo "Error al registrar la Herramienta";
            }
        }
    }

    //Editamos Herramienta
    public function edit(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];


            $estados = $this->modeloEstado->selectEstado();
            $herramienta['idEstadoFK'] = $_POST['estado'];
            



            $herramienta = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'imagen' => null,
                'fechaRegistro' => $_POST['fechaRegistro'],
                'idEstadoFK' => $_POST['estado'],
                'mantenimiento' => $_POST['mantenimiento'],
                'cantidad' => $_POST['cantidad'],
            ];


            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($file);
                if (strpos($mime, 'image/') === 0) {
                    $herramienta['imagen'] = file_get_contents($file);
                } else {
                    echo "El archivo cargado no es una imagen válida.";
                    return;
                }
            }


            $resultado = $this->model->update($id, $herramienta);

            if ($resultado) {
                header('Location: index.php?c=herramienta&f=index');
            } else {
                echo "Error al editar la Herramienta";
            }
        }
    }
    
    //Buscar herramienta por nombre
    public function search(){
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultado = $this->model->buscar($parametro);
        $titulo = "Buscar herramientas";
        require_once VHERRAMIENTAS . 'list.php';
    }

    //Registro de Reserva de Herramienta
    public function reservarHerramienta(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reserva = [
                'estado' => 'Reservado',
                'idHerramientaFK' => $_POST['idHerramienta'],
                'idUsuarioFK' => 1,
                'cantidad' => $_POST['cantidad'],
                'fechaInicio' => $_POST['fechaInicio'],
                'fechaFin' => $_POST['fechaFin'],
                'proposito' => $_POST['proposito'],
                'capacitacion' => isset($_POST['capacita']) ? true : false
            ];
    
            $resultado = $this->model->insert_Reserva($reserva);
    
            if ($resultado) {
                $this->redirectWithMessage(true, 'Reserva realizada con éxito', '', 'index.php?c=herramienta&f=index_Herramienta');
            } else {
                $this->redirectWithMessage(false, '', 'Error al realizar la reserva', 'index.php?c=herramienta&f=index_Herramienta');
            }
        }
    }
    
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }

}
