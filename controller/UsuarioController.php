<!--    Autor: Palacios Herdoiza Roitman Andres  -->
<?php 
require_once 'model/dto/Usuario.php';
require_once 'model/dao/UsuarioDAO.php';

class UsuarioController
{

    private $model;

    public function __construct()
    {
        $this->model = new UsuarioDAO();
    }

    public function index(){
     $resultados = $this->model->selectAll("");
        $titulo = "Buscar usuarios";
        require_once VUSUARIOS . "list.php";
        if (count($resultados) > 0) {
            echo "Usuarios cargados correctamente";
        } else {
            echo "No se encontraron usuarios";
        }

    }

    public function profile()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $usuario = $this->model->selectOne($userId);

        if (!$usuario) {
            header("Location: error.php");
            exit();
        }

        $titulo = "Perfil del Usuario";
        require_once VUSUARIOS . 'perfil.php';
    }

     public function search(){
        $parametro = htmlentities($_POST['b']??"");
        $resultados = $this->model->selectAll($parametro);     
        $titulo = "Buscar usuarios";
        require_once VUSUARIOS . 'list.php';
     }

        public function view_new(){
        $titulo = "Registrar usuario";



        }
    public function new(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario();
            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellido($_POST['apellido']);
            $usuario->setCorreo($_POST['email']);
            $usuario->setContrasena(password_hash($_POST['password'], PASSWORD_BCRYPT));

            $resultado = $this->model->insert($usuario);

            if ($resultado) {
                echo "Usuario registrado correctamente";
            } else {
                echo "Error al registrar el usuario";
            }
        } else {
            $titulo = "Registrar usuario";
            require_once VUSUARIOS . "register.php";
        }
    }
}

?>