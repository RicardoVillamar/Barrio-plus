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
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            require_once 'view/usuario/login.php';
            exit();
        }

        $usuario = $_SESSION['usuario'];

        // Verificar si el usuario tiene un ID válido
        if (!isset($usuario['idUsuario']) || empty($usuario['idUsuario'])) {
            header("Location: error.php");
            exit();
        }

        $userId = $usuario['idUsuario'];

        // Consultar reservas del usuario
        $reservasHerramientas = $this->model->selectReservasHerramientasByUserId($userId) ?? [];
        $reservasInstalaciones = $this->model->selectReservasInstalacionesByUserId($userId) ?? [];

        // Hacer disponible la variable $usuario, $reservasHerramientas y $reservasInstalaciones en la vista
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
  

            $usuario = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['email'],
                'contrasena' => $_POST['contrasena'], // No se utiliza password_hash
                'idRolFK' => isset($_POST['contribuidor']) ? 3 : 2, // Asignar el rol basado en la acción
                
                'imagen' => null
            ];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $usuario['imagen'] = file_get_contents($file);
            }

            $resultado = $this->model->insert($usuario);

            if ($resultado) {
                
                header('Location: index.php?c=instalacion&f=index_instalacion');
            } else {
                echo "Error al registrar el usuario ";
                
            }
        } else {
            $titulo = "Registrar Usuario";
            require_once VUSUARIOS.'.new.php';
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
                'contrasena' => $_POST['contrasena'], // No se utiliza password_hash
                'idRolFK' => isset($_POST['contribuidor']) ? 3 : 2, // Asignar el rol basado en la acción
                
               // 'imagen' => null
            ];

           /* if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen']['tmp_name'];
                $usuario['imagen'] = file_get_contents($file);
            }*/

            $resultado = $this->model->update($usuario);

            if ($resultado) {
                
                //header('Location: index.php?c=instalacion&f=index_instalacion');
                var_dump($resultado);
            } else {
                echo "Error al registrar el usuario ";
                
            }
        } else {
            $titulo = "Registrar Usuario";
            require_once VUSUARIOS.'.new.php';
        }
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, también se debe borrar la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();

        // Redirigir al usuario a la página de inicio de sesión
        header("Location: index.php?c=usuario&f=login");
        exit();
    }

    public function buscarReservasPorHerramienta() {
        if (isset($_GET['query'])) {
            if (!isset($_SESSION)) session_start();
            $usuario = $_SESSION['usuario'];
            $idUsuario = $usuario['idUsuario'];
            $query = $_GET['query'];
            $resultados = $this->model->buscarReservasPorHerramienta($idUsuario, $query);
            require_once 'view/usuario/usuario.list.php';
        } else {
            // Manejar el caso donde no hay query
            $resultados = [];
            require_once 'view/usuario/usuario.list.php';
        }
    }

    public function obtenerRolUsuario()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            return $_SESSION['usuario']['rol'];
        }
        return null;
    }
}

?>