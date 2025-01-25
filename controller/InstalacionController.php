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
        $this->modeloUsuario = new UsuarioDAO();
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
        $tipos = $this->modeloTipo->getTipos();
        $estados = $this->modeloEstado->selectEstado();
        $usuario = $this->modeloUsuario->selectAll('');
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

            // Obtener todos los tipos y estados disponibles
            $tipos = $this->modeloTipo->getTipos();
            $estados = $this->modeloEstado->selectEstado();

            // Buscar el idTipo correspondiente al nombre recibido en $_POST['tipo']
            $idTipo = null;
            foreach ($tipos as $tipo) {
                if ($tipo['nombre'] === $_POST['tipo']) {
                    $idTipo = $tipo['idTipo'];
                    break;
                }
            }

            if ($idTipo === null) {
                echo "Error: Tipo no válido.";
                return;
            }

            // Buscar el idEstado correspondiente al nombre recibido en $_POST['estado']
            $idEstado = null;
            foreach ($estados as $estado) {
                if ($estado['nombre'] === $_POST['estado']) {
                    $idEstado = $estado['idEstado'];
                    break;
                }
            }

            if ($idEstado === null) {
                echo "Error: Estado no válido.";
                return;
            }

            // Preparar los datos de la instalación
            $instalacion = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tamano' => $_POST['tamano'],
                'idTipoFK' => $idTipo, // Guardar el idTipo en lugar del nombre
                'idEstadoFK' => $idEstado, // Guardar el idEstado en lugar del nombre
                'idContribuidorFK' => $_POST['contribuidor'],
                'imagen' => null,
            ];

            // Manejar la imagen si está disponible
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $instalacion['imagen'] = file_get_contents($file);
            }

            // Actualizar en la base de datos
            $resultado = $this->model->update($id, $instalacion);

            if ($resultado) {
                header('Location: index.php?c=instalacion&f=index_instalacion');
            } else {
                echo "Error al registrar la instalación";
            }
        }
    }
}
