<?php
//Autor: Villamar Minuche Ricardo Daniel
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

    public function index()
    {

        $estados = $this->modeloEstado->selectEstado();
        $tipos = $this->modeloTipo->getTipos();
        $resultados = $this->model->selectAll();

        $titulo = 'Instalaciones';

        require_once VINSTALACIONRESERVA . 'list.php';
    }

    public function view_reservar()
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

    public function new_instalacion()
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = [];

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

            if (empty($_POST['tipo'])) {
                $errores[] = "Debe seleccionar un tipo.";
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $fileType = mime_content_type($_FILES['imagen']['tmp_name']);
                if (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $errores[] = "Solo se permiten imágenes JPG, PNG y GIF.";
                }
            }

            if (count($errores) > 0) {
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
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
                header('Location: index.php?c=instalacion&f=index_instalacion');
            } else {
                echo "Error al registrar la instalación.";
            }
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
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
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
                header('Location: index.php?c=instalacion&f=index_instalacion');
            } else {
                echo "Error al actualizar la instalación.";
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

    public function reservarInstalacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservacionInstalacion = [
                'idInstalacionFK' => $_POST['id'],
                // 'idUsuarioFK' => $_SESSION['idUsuario'],
                'idUsuarioFK' => 1,
                'telefono' => $_POST['telefono'],
                'miembro' => $_POST['miembro'],
                'fechaInicio' => $_POST['fechaInicio'],
                'fechaFin' => $_POST['fechaFin'],
                'personasEsperadas' => $_POST['personasEsperadas'],
                'observaciones' => $_POST['observaciones'],
                'proposito' => $_POST['proposito'],
                'idEstadoFK' => 2
            ];

            $resultado = $this->model->insertReservaciones($reservacionInstalacion);

            if ($resultado) {
                $this->redirectWithMessage(true, 'Reservación exitosa', '', 'index.php?c=instalacion&f=index');
            } else {
                $this->redirectWithMessage(false, '', 'Error al reservar la instalación', 'index.php?c=instalacion&f=index');
            }
        }
    }
}
