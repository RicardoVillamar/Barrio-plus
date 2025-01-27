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
    public function index()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        if ($usuario['idRolFK'] != 1 && $usuario['idRolFK'] != 3) {
            echo "<script>";
            echo "alert('No puedes ingresar porque no estas logeado.');";
            echo "window.location.href = 'login.php';";
            echo "</script>";
            exit;
        }

        $estados = $this->modeloEstado->selectEstado();
        $resultado = $this->model->selectAll();

        $titulo = 'Herramienta';

        require_once VHERRAMIENTAS . 'list.php';
    }

    //Pagina de reserva de herramienta
    public function view_reservar($errores = [], $datos = [])
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        if ($usuario['idRolFK'] != 2) {
            echo "<script>";
            echo "alert('No puedes reservar ninguna herramienta porque no estas logeado.');";
            echo "window.location.href = 'login.php';";
            echo "</script>";
            exit;
        }

        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);

        $titulo = 'Reservar de Herramienta';

        require_once VHERRAMIENTASRESERVA . 'new.php';
    }

    //Pagina prin de herramienta
    public function index_Herramienta()
    {
        $resultado = $this->model->selectAll();

        $titulo = 'Herramienta registradas';

        require_once VHERRAMIENTASRESERVA . 'list.php';
    }

    //Eliminar herramienta
    public function view_eliminar()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);

        if ($usuario['idRolFK'] == 1 || ($usuario['idRolFK'] == 3 && $herramienta['idUsuarioFK'] == $usuario['idUsuario'])) {
            $this->model->delete($id);
            header("Location: index.php?c=herramienta&f=index");
            exit;
        }

        echo "<script>";
        echo "alert('No tienes permiso para eliminar esta herramienta.');";
        echo "window.location.href = '?c=herramienta&f=index';";
        echo "</script>";
        exit;

        $this->model->delete($id);
        header("Location: index.php?c=herramienta&f=index");
    }


    //Editar herramienta
    public function view_editar()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);

        if ($usuario['idRolFK'] == 1 || ($usuario['idRolFK'] == 3 && $herramienta['idUsuarioFK'] == $usuario['idUsuario'])) {
            $estados = $this->modeloEstado->selectEstado();
            $titulo = 'Editar Herramienta';
            require_once VHERRAMIENTAS . 'edit.php';
        } else {
            echo "<script>";
            echo "alert('No tienes permiso para editar esta herramienta.');";
            echo "window.location.href = '?c=herramienta&f=index';";
            echo "</script>";
            exit;
        }
    }

    //Registrar Herramienta
    public function new_Herramienta()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        if ($usuario['idRolFK'] != 1 && $usuario['idRolFK'] != 3) {
            echo "<script>";
            echo "alert('No puedes registrar una herramienta porque no estas logeado');";
            echo "window.location.href = 'login.php';";
            echo "</script>";
            exit;
        }

        $estados = $this->modeloEstado->selectEstado();

        $titulo = 'Registrar Herramienta';
        require_once VHERRAMIENTAS . 'new.php';
    }

    //Insertar Herramientas
    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            list($exito, $errores) = $this->herra($_POST, $_FILES);

            if (!$exito) {
                $estados = $this->modeloEstado->selectEstado();
                $titulo = 'Registrar Herramienta';
                require_once VHERRAMIENTAS . 'new.php';
                return;
            }
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

    function clearElement($element)
    {
        $element = trim($element);
        $element = stripslashes($element);
        $element = htmlspecialchars($element);
        return $element;
    }

    //Editamos Herramienta
    public function edit()
    {
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
    public function search()
    {
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultado = $this->model->buscar($parametro);
        $titulo = "Buscar herramientas";
        require_once VHERRAMIENTAS . 'list.php';
    }

    public function searchReserva()
    {
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultado = $this->model->buscar($parametro);
        $estados = $this->modeloEstado->selectEstado();
        $titulo = "Buscar herramientas";
        require_once VHERRAMIENTASRESERVA . 'list.php';
    }

    //Registro de Reserva de Herramienta
    public function reservarHerramienta()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }


        $usuario = $_SESSION['usuario'];
        if ($usuario['idRolFK'] != 2) {
            echo "<script>";
            echo "alert('No puedes reservar porque no estas logeado.');";
            echo "window.location.href = 'login.php';";
            echo "</script>";
            exit;
        }

        $id = htmlentities($_GET['id']);
        $herramienta = $this->model->selectOne($id);
        $estados = $this->modeloEstado->selectEstado();
        $xd = $this->model->selectAll();

        $errores = [];
        $datos = $_POST;

        $idHerramienta = $this->clearElement($_POST['idHerramienta'] ?? '');
        if (empty($idHerramienta) || !is_numeric($idHerramienta)) {
            $errores['idHerramienta'] = "La ID de la herramienta no es válida.";
        }

        $cantidad = $this->clearElement($_POST['cantidad'] ?? '');
        if (empty($cantidad) || !is_numeric($cantidad) || $cantidad < 1) {
            $errores['cantidad'] = "La cantidad debe ser un número mayor a 0.";
        }

        $fechaInicio = $this->clearElement($_POST['fechaInicio'] ?? '');
        if (empty($fechaInicio) || !strtotime($fechaInicio)) {
            $errores['fechaInicio'] = "La fecha de inicio no es válida.";
        }

        $fechaFin = $this->clearElement($_POST['fechaFin'] ?? '');
        if (empty($fechaFin) || !strtotime($fechaFin)) {
            $errores['fechaFin'] = "La fecha de fin no es válida.";
        }

        if (!empty($fechaInicio) && !empty($fechaFin) && strtotime($fechaFin) <= strtotime($fechaInicio)) {
            $errores['fechas'] = "La fecha de fin debe ser posterior a la fecha de inicio.";
        }

        $proposito = $this->clearElement($_POST['proposito'] ?? '');
        if (empty($proposito)) {
            $errores['proposito'] = "El propósito de uso es obligatorio.";
        }

        if (!empty($errores)) {
            $this->view_reservar($errores, $datos);
            return;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reserva = [
                'idEstadoFK' => 2,
                'idHerramientaFK' => $_POST['idHerramienta'],
                'idUsuarioFK' => $_SESSION['usuario']['idUsuario'],
                //'idUsuarioFK' => 1,
                'cantidad' => $_POST['cantidad'],
                'fechaInicio' => $_POST['fechaInicio'],
                'fechaFin' => $_POST['fechaFin'],
                'proposito' => $_POST['proposito'],
                'capacitacion' => isset($_POST['capacita']) ? true : false
            ];

            $resultado = $this->model->insert_Reserva($reserva);

            if ($resultado) {
                $this->redirectWithMessage(
                    true,
                    'Reserva realizada con éxito',
                    '',
                    'index.php?c=herramienta&f=index_Herramienta'
                );
            } else {
                $this->redirectWithMessage(
                    false,
                    '',
                    'Error al realizar la reserva',
                    'index.php?c=herramienta&f=index_Herramienta'
                );
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



    private function herra(array $data, array $files): array
    {
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

        if (empty($data['descripcion'])) {
            $errores['descripcion'] = "La descripción de la herramienta es obligatorio";
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
