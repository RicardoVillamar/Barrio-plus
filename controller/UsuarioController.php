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
            require_once 'view/usuario/login.php'; 
            exit();
        }

        $userId = $_SESSION['user_id'];
        $usuario = $this->model->selectOne($userId);

        if (!$usuario) {
            header("Location: error.php");
            exit();
        }

        $titulo = "Perfil del Usuario";
        require_once VUSUARIOS.'list.php'; 
    }

     public function search(){
        $parametro = htmlentities($_POST['b']??"");
        $resultados = $this->model->selectAll($parametro);     
        $titulo = "Buscar usuarios";
       
     }

        public function view_new(){
        $titulo = "Registrar usuario";
        require_once VUSUARIOS . 'new.php';


        }
        public function new() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['email'];
                $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    

                $this->model->insert($nombre, $apellido, $correo, $contrasena);

                header("Location: index.php?c=usuario&f=login");
                exit();
            } else {
                $titulo = "Registrar Usuario";
                require_once 'view/usuario/usuario.new.php';
            }
        }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['email'];
            $contrasena = $_POST['password'];
    
            $usuario = $this->model->selectOneByEmail($correo);
    
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                session_start();
                $_SESSION['user_id'] = $usuario['id'];
                header("Location: index.php?c=usuario&f=profile");
                exit();
            } else {
                echo "Correo o contraseña incorrectos";
            }
        } else {
            $titulo = "Iniciar sesión";
            require_once 'view/usuario/login.php'; 
        }
    }


    
}

?>