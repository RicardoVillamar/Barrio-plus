<!-- Autor: Villamar Minuche Ricardo Daniel -->
<?php
require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dto/Instalacion.php';
require_once 'model/dao/EstadoDAO.php';
require_once 'model/dao/TiposDAO.php';
require_once 'model/dao/UsuarioDAO.php';


class InstalacionController
{

    private $model, $modeloEstado, $modeloTipo, $modeloUsuario;

    public function __construct()
    {
        $this->model = new InstalacionesDAO();
        $this->modeloEstado = new EstadoDAO();
        $this->modeloTipo = new TiposDAO();
    }

    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }


    public function index()
    {

        $estados = $this->modeloEstado->selectEstado();
        $tipos = $this->modeloTipo->getTipos();
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones';

        require_once VINSTALACIONRESERVA . 'list.php';
    }

    public function view_reservar($errores = [], $datos = [])
    {
        $id = htmlentities($_GET['id']);
        $instalacion = $this->model->selectOne($id);

        $titulo = 'Reservar Instalacion';

        require_once VINSTALACIONRESERVA . 'new.php';
    }


    public function searchReservas()
    {
        $nombre = htmlentities($_POST['buscar'] ?? "");
        $resultados = $this->model->searchNombre($nombre);
        $tipos = $this->modeloTipo->getTipos();
        $estados = $this->modeloEstado->selectEstado();

        $titulo = 'Instalaciones registradas';

        require_once VINSTALACIONRESERVA . 'list.php';
    }

    //instalaciones
    public function index_instalacion()
    {
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones registradas';

        require_once VINSTALACION . 'list.php';
    }

    public function search()
    {
        $nombre = htmlentities($_POST['buscar'] ?? "");
        $resultados = $this->model->searchNombre($nombre);

        $titulo = 'Instalaciones registradas';

        require_once VINSTALACION . 'list.php';
    }

    public function view_eliminar()
    {
        $id = htmlentities($_GET['id']);
        $instalacion = $this->model->delete($id);
        $titulo = 'Eliminar Instalacion';
        header("Location: index.php?c=instalacion&f=index_instalacion");
    }

    public function view_editar()
    {
        $id = htmlentities($_GET['id']);
        $instalacion = $this->model->selectOne($id);
        $tipos = $this->modeloTipo->getTipos();
        $estados = $this->modeloEstado->selectEstado();


        $titulo = 'Editar Instalacion';

        require_once VINSTALACION . 'edit.php';
    }

    public function new_instalacion($errores = [], $datos = [])
    {
        $estados = $this->modeloEstado->selectEstado();
        $tipos = $this->modeloTipo->getTipos();
        $titulo = 'Registrar Instalacion';
        require_once VINSTALACION . 'new.php';
    }

    function clearElement($element)
    {
        $element = trim($element);
        $element = stripslashes($element);
        $element = htmlspecialchars($element);
        return $element;
    }


    public function insert()
    {
        $errores = [];
        $datos = $_POST;

        $nombre = $this->clearElement($_POST['nombre']);
        if (empty($nombre)) {
            $errores['nombre'] = "El nombre es obligatorio.";
        }

        $descripcion = $this->clearElement($_POST['descripcion']);
        if (empty($descripcion)) {
            $errores['descripcion'] = "La descripción es obligatoria.";
        }

        $precio = $this->clearElement($_POST['precio']);
        if (empty($precio) || !is_numeric($precio) || $precio <= 0) {
            $errores['precio'] = "El precio debe ser un número positivo.";
        }

        $tamano = $this->clearElement($_POST['tamano']);
        if (empty($tamano)) {
            $errores['tamano'] = "El tamaño es obligatorio.";
        }

        if (empty($_POST['tipo'])) {
            $errores['tipo'] = "Debe seleccionar un tipo.";
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileType = mime_content_type($_FILES['imagen']['tmp_name']);
            if (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                $errores['imagen'] = "Solo se permiten imágenes JPG, PNG y GIF.";
            }
        }

        if (!empty($errores)) {
            $this->new_instalacion($errores, $datos);
            return;
        }

        $instalacion = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'tamano' => $tamano,
            'idTipoFK' => $_POST['tipo'],
            'idEstadoFK' => $_POST['estado'],
            'imagen' => null,
        ];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['imagen']['tmp_name'];
            $instalacion['imagen'] = file_get_contents($file);
        }

        $resultado = $this->model->insert($instalacion);

        if ($resultado) {
            $this->redirectWithMessage(true, 'Instalación registrada correctamente.', '', 'index.php?c=instalacion&f=index_instalacion');
        } else {
            $this->redirectWithMessage(false, '', 'Error al registrar la instalación.', 'index.php?c=instalacion&f=index_instalacion');
        }
    }



    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $errores = [];

            $tipos = $this->modeloTipo->getTipos();
            $estados = $this->modeloEstado->selectEstado();

            $nombre = $this->clearElement($_POST['nombre']);
            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio.";
            }

            $descripcion = $this->clearElement($_POST['descripcion']);
            if (empty($descripcion)) {
                $errores[] = "La descripción es obligatoria.";
            }

            $precio = $this->clearElement($_POST['precio']);
            if (empty($precio) || !is_numeric($precio) || $precio <= 0) {
                $errores[] = "El precio debe ser un número positivo.";
            }

            $tamano = $this->clearElement($_POST['tamano']);
            if (empty($tamano)) {
                $errores[] = "El tamaño es obligatorio.";
            }

            $idTipo = null;
            foreach ($tipos as $tipo) {
                if ($tipo['nombre'] === $_POST['tipo']) {
                    $idTipo = $tipo['idTipo'];
                    break;
                }
            }

            if ($idTipo === null) {
                $errores[] = "Tipo no válido.";
            }

            $idEstado = null;
            foreach ($estados as $estado) {
                if ($estado['nombre'] === $_POST['estado']) {
                    $idEstado = $estado['idEstado'];
                    break;
                }
            }

            if ($idEstado === null) {
                $errores[] = "Estado no válido.";
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $fileType = mime_content_type($_FILES['imagen']['tmp_name']);
                if (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $errores[] = "Solo se permiten imágenes JPG, PNG y GIF.";
                }
            }

            if (count($errores) > 0) {
                echo "<script>";
                echo "alert('" . implode("\\n", $errores) . "');";
                echo "window.history.back();";
                echo "</script>";
                return;
            }

            $instalacion = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'tamano' => $tamano,
                'idTipoFK' => $idTipo,
                'idEstadoFK' => $idEstado,
                'imagen' => null,
            ];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $instalacion['imagen'] = file_get_contents($file);
            }

            $resultado = $this->model->update($id, $instalacion);

            if ($resultado) {
                $this->redirectWithMessage(true, 'Instalación editada correctamente.', '', 'index.php?c=instalacion&f=index_instalacion');
            } else {
                $this->redirectWithMessage(false, '', 'Error al actualizar la instalación.', 'index.php?c=instalacion&f=index_instalacion');
            }
        }
    }

    public function reservarInstalacion()
    {
        $id = htmlentities($_GET['id']);
        $estados = $this->modeloEstado->selectEstado();
        $tipos = $this->modeloTipo->getTipos();
        $resultados = $this->model->selectAll();
        $instalacion = $this->model->selectOne($id);

        $errores = [];
        $datos = $_POST;

        $idInstalacion = $this->clearElement($_POST['id']);
        if (empty($idInstalacion) || !is_numeric($idInstalacion)) {
            $errores['idInstalacion'] = "ID de la instalación no válido.";
        }

        $telefono = $this->clearElement($_POST['telefono']);
        if (empty($telefono) || !preg_match('/^[0-9]{10}$/', $telefono)) {
            $errores['telefono'] = "El teléfono debe ser un número válido de 10 dígitos.";
        }

        if (!isset($_POST['miembro'])) {
            $errores[] = "Debe seleccionar si es miembro o no.";
        } else {
            $miembro = $this->clearElement($_POST['miembro']);
            if (!in_array($miembro, ['si', 'no'])) {
                $errores['miembro'] = "El campo 'miembro' debe ser 'si' o 'no'.";
            }
        }

        $fechaInicio = $this->clearElement($_POST['fechaInicio']);
        if (empty($fechaInicio) || !strtotime($fechaInicio)) {
            $errores['fechaInicio'] = "La fecha de inicio no es válida.";
        }

        $fechaFin = $this->clearElement($_POST['fechaFin']);
        if (empty($fechaFin) || !strtotime($fechaFin)) {
            $errores['fechaFin'] = "La fecha de fin no es válida.";
        }

        if (!empty($fechaInicio) && !empty($fechaFin) && strtotime($fechaFin) <= strtotime($fechaInicio)) {
            $errores[] = "La fecha de fin debe ser posterior a la fecha de inicio.";
        }

        $personasEsperadas = $this->clearElement($_POST['personasEsperadas']);
        if (empty($personasEsperadas) || !is_numeric($personasEsperadas) || $personasEsperadas <= 0) {
            $errores['personasEsperadas'] = "El número de personas esperadas debe ser un número positivo.";
        }

        $observaciones = $this->clearElement($_POST['observaciones']);
        if (!empty($observaciones) && strlen($observaciones) > 255) {
            $errores['observaciones'] = "Las observaciones no deben exceder los 255 caracteres.";
        }

        $proposito = $this->clearElement($_POST['proposito']);
        if (empty($proposito)) {
            $errores['propositos'] = "El propósito de la reservación es obligatorio.";
        }



        if (!empty($errores)) {
            $this->view_reservar($errores, $datos);
            return;
        }

        $reservacionInstalacion = [
            'idInstalacionFK' => $idInstalacion,
            // 'idUsuarioFK' => $_SESSION['idUsuario'],
            'idUsuarioFK' => 1,
            'telefono' => $telefono,
            'miembro' => $miembro,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'personasEsperadas' => $personasEsperadas,
            'observaciones' => $observaciones,
            'proposito' => $proposito,
            'idEstadoFK' => 2,
        ];

        $resultado = $this->model->insertReservaciones($reservacionInstalacion);

        if ($resultado) {
            $this->redirectWithMessage(true, 'Reserva registrada correctamente.', '', 'index.php?c=instalacion&f=index');
        } else {
            $this->redirectWithMessage(false, '', 'Error al registrar la instalación.', 'index.php?c=instalacion&f=index');
        }
    }
}
