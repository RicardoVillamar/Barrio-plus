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


    public function index()
    {
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
        if(!isset($_SESSION)){session_start();}
        if (!isset($_SESSION['usuario'])) {
            require_once 'view/usuario/login.php';
            exit();
        }

        $usuario = $_SESSION['usuario'];
        $userId = $usuario['idUsuario']; 

        if (!$usuario) {
            header("Location: error.php");
            exit();
        }

        // Asegurar que las reservas sean arrays vacíos si no hay resultados
        $reservasHerramientas = $this->model->selectReservasHerramientasByUserId($userId) ?? [];
        $reservasInstalaciones = $this->model->selectReservasInstalacionesByUserId($userId) ?? [];

        // Agregar datos adicionales al usuario
        $usuario['reservasHerramientas'] = $reservasHerramientas;
        $usuario['reservasInstalaciones'] = $reservasInstalaciones;

        // Hacer disponible la variable $usuario en la vista
        $titulo = "Perfil del Usuario";
        require_once 'view/usuario/usuario.list.php';
    }


    public function search()
    {
        $parametro = htmlentities($_POST['b'] ?? "");
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar usuarios";
    }

    public function view_new()
    {
        $titulo = "Registrar usuario";
        require_once VUSUARIOS . 'new.php';
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rol = ($_POST['accion'] == 'contribuidor') ? 3 : 2;

            $usuario = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['email'],
                'contrasena' => $_POST['contrasena'], // No se utiliza password_hash
                'rol' => $rol // Asignar el rol basado en la acción
            ];

            $this->model->insert($usuario);

            require_once 'view/usuario/login.php';
            exit();
        } else {
            $titulo = "Registrar Usuario";
            require_once 'view/usuario/usuario.new.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['email'];
            $contrasena = $_POST['password'];

            $usuario = $this->model->selectOneByEmail($correo);

            if ($usuario && $usuario['contrasena'] === $contrasena) {
                session_start();
                // Guardamos el objeto usuario
                $_SESSION['usuario'] = $usuario;
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

    public function view_edit()
    {
        if(!isset($_SESSION)){session_start();}
        if (!isset($_SESSION['usuario'])) {
            require_once 'view/usuario/login.php';
            exit();
        }

        $usuario = $_SESSION['usuario'];
        $userId = $usuario['idUsuario'];

        if (!$usuario) {
            header("Location: error.php");
            exit();
        }

        // Recuperar la información del usuario desde la base de datos
        $usuario = $this->model->getUserById($userId);

        // Hacer disponible la variable $usuario en la vista
        $titulo = "Editar Información del Usuario";
        require_once 'view/usuario/usuario.edit.php';
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = [
                'idUsuario' => $_POST['idUsuario'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'contrasena' => $_POST['contrasena']
            ];

            $this->model->update($usuario);

            require_once 'view/usuario/login.php';
            exit();
        } else {
            $titulo = "Editar Usuario";
            require_once 'view/usuario/usuario.edit.php';
        }
    }
}

?>