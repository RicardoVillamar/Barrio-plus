<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once 'model/dao/InstalacionDAO.php';
require_once 'model/dto/Instalacion.php';
require_once 'model/dao/EstadoDAO.php';
require_once 'model/dao/TiposDAO.php';


class InstalacionController
{

    private $model, $modeloEstado, $modeloTipo;

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

    //instalaciones
    public function index_instalacion()
    {
        $resultados = $this->model->selectAll();

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
        // $resultados = $this->model->selectAll();

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

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $instalacion = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tamano' => $_POST['tamano'],
                'idTipoFK' => $_POST['tipo'],
                'idEstadoFK' => $_POST['estado'],
                'idContribuidorFK' => $_POST['contribuidor'],
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
                echo "Error al registrar la instalación";
            }
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $instalacion = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tamano' => $_POST['tamano'],
                'idTipoFK' => $_POST['tipo'],
                'idEstadoFK' => $_POST['estado'],
                'idContribuidorFK' => $_POST['contribuidor'],
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
                echo "Error al actualizar la instalación";
            }
        } else {
            $id = htmlentities($_GET['id']);
            $instalacion = $this->model->selectOne($id);
            $estados = $this->modeloEstado->selectEstado();
            $tipos = $this->modeloTipo->getTipos();
            $titulo = 'Editar Instalacion';
            require_once VINSTALACION . 'edit.php';
        }
    }
}
