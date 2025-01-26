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
            list($exito, $errores) = $this->herra($_POST, $_FILES);
            
            if (!$exito) {
                $estados = $this->modeloEstado->selectEstado();
                $titulo = 'Registrar Herramienta';
                require_once VHERRAMIENTAS . 'new.php';
                return;}
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
                    $herramienta['imagen'] = file_get_contents($_FILES['imagen']['tmp_name']);
                }
                
                $resultado = $this->model->insert($herramienta);
                if ($resultado) {
                    header('Location: index.php?c=herramienta&f=index');
                } else {
                    echo "Error al registrar la herramienta.";
                }
            }
        }

    //Editamos Herramienta
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
    
            list($exito, $errores) = $this->herra($_POST, $_FILES);
    
            if (!$exito) {
                $herramienta = $this->model->selectOne($id);
                $estados = $this->modeloEstado->selectEstado();
                $titulo = 'Editar Instalación';
                require_once VHERRAMIENTAS . 'edit.php';
                return;
            }
    
            $herramientaData = [
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
                    $herramientaData['imagen'] = file_get_contents($file);
                } else {
                    echo "El archivo cargado no es una imagen válida.";
                    return;
                }
            }
    
            $resultado = $this->model->update($id, $herramientaData);
    
            if ($resultado) {
                header('Location: index.php?c=herramienta&f=index');
            } else {
                echo "Error al editar la herramienta";
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

    public function searchReserva(){
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultado = $this->model->buscar($parametro);
        $titulo = "Buscar herramientas";
        require_once VHERRAMIENTASRESERVA . 'list.php';
    }

    //Registro de Reserva de Herramienta
    public function reservarHerramienta(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = [];

            $idHerramienta = $this->clearElement($_POST['id']);
            if (empty($idHerramienta) || !is_numeric($idHerramienta)) {
                $errores[] = "La id de Herramienta no es valida.";
            }

            $cantidad = $this->clearElement($_POST['cantidad']);
            if (empty($cantidad) || !is_numeric($cantidad) || $cantidad < 1) {
                $errores[] = "El número de herramienta.";
            }

            $fechaInicio = $this->clearElement($_POST['fechaInicio']);
            if (empty($fechaInicio) || !strtotime($fechaInicio)) {
                $errores[] = "La fecha de inicio no es válida.";
            }

            $fechaFin = $this->clearElement($_POST['fechaFin']);
            if (empty($fechaFin) || !strtotime($fechaFin)) {
                $errores[] = "La fecha de fin no es válida.";
            }

            if (!empty($fechaInicio) && !empty($fechaFin) && strtotime($fechaFin) <= strtotime($fechaInicio)) {
                $errores[] = "La fecha de fin debe ser posterior a la fecha de inicio.";
            }


            if (count($errores) > 0) {
                echo "<script>";
                echo "alert('" . implode("\\n", $errores) . "');";
                echo "window.history.back();";
                echo "</script>";
                return;
            }
            
            $reserva = [
                'idEstadoFK' => 2,
                'idHerramientaFK' => $_POST['idHerramienta'],
                // 'idUsuarioFK' => $_SESSION['idUsuario'],
                'idUsuarioFK' => 1,
                'cantidad' => $_POST['cantidad'],
                'fechaInicio' => $_POST['fechaInicio'],
                'fechaFin' => $_POST['fechaFin'],
                'proposito' => $_POST['proposito'],
                'capacitacion' => isset($_POST['capacita']) ? true : false
            ];
    
            $resultado = $this->model->insert_Reserva($reserva);
    
            if ($resultado) {
                $this->redirectWithMessage(true, 'Reserva realizada con éxito', '', 
                'index.php?c=herramienta&f=index_Herramienta');
            } else {
                $this->redirectWithMessage(false, '', 'Error al realizar la reserva', 
                'index.php?c=herramienta&f=index_Herramienta');
            }
        }
    }
    
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }



    private function herra(array $data, array $files): array{
        $errores = [];
        
        if (empty($data['nombre']) || !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $data['nombre'])) {
            $errores['nombre'] = "El nombre es obligatorio y solo debe contener letras.";
        }
    
        if (isset($files['imagen']) && $files['imagen']['error'] === UPLOAD_ERR_OK) {
            $file = $files['imagen']['tmp_name'];
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file);
            if (strpos($mime, 'image/') !== 0) {
                $errores['imagen'] = "El archivo cargado no es una imagen válida.";
            }
        } else {
            $errores['imagen'] = "La imagen es obligatoria.";
        }
    
        if (empty($data['descripcion']) || strlen($data['descripcion']) < 10) {
            $errores['descripcion'] = "La descripción de la herramienta es obligatorio.";
        }
    
        if (!isset($data['precio']) || !is_numeric($data['precio']) || $data['precio'] <= 0) {
            $errores['precio'] = "El precio debe ser un número mayor a 0.";
        }
    
        if (empty($data['fechaRegistro']) || !$this->fechaValida($data['fechaRegistro'])) {
            $errores['fechaRegistro'] = "La fecha de registro no es válida.";
        }
    
        if (empty($data['estado']) || !is_numeric($data['estado'])) {
            $errores['estado'] = "El estado seleccionado no es válido.";
        }
    
        if (!empty($data['mantenimiento']) && strlen($data['mantenimiento']) < 10) {
            $errores['mantenimiento'] = "El mantenimiento hechos de la herramientas es opcional";
        }
    
        if (!isset($data['cantidad']) || !is_numeric($data['cantidad']) || $data['cantidad'] <= 0) {
            $errores['cantidad'] = "La cantidad debe ser un número mayor a 0.";
        }
        return [empty($errores), $errores];
    }
    
    private function fechaValida(string $fecha): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $fecha);
        return $d && $d->format('Y-m-d') === $fecha;
    }
}
