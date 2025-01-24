<!-- Autor: Freire Chavez Jose Andres -->
<?php
require_once 'model/dto/Publicacion.php';
require_once 'model/dao/PublicacionDAO.php';
require_once 'model/dao/UsuarioDAO.php';

class PublicacionController
{
    private $model;

    public function __construct()
    {
        $this->model = new PublicacionDAO();
    }

    function limpiar($dato)
    {
        $dato = trim($dato);
        $dato = stripcslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    public function index()
    {
        $resultados = $this->model->selectAll("");
        $titulo = "Buscar publicaciones";
        require_once VPUBLICACIONES . 'list.php';
        if (count($resultados) > 0) {
            echo "Publicaciones cargadas correctamente";
        } else {
            echo "No se encontraron publicaciones";
        }
    }

    public function search()
    {
        $parametro = !empty($_POST["b"]) ? limpiar($_POST["b"]) : "";
        $resultados = $this->model->selectAll($parametro);
        $titulo = "Buscar publicaciones";
        require_once VPUBLICACIONES . 'list.php';
        if (count($resultados) > 0) {
            echo "Publicaciones cargadas correctamente";
        } else {
            echo "No se encontraron publicaciones";
        }
    }

    public function delete()
    {
        $id = !empty($_REQUEST["id"]) ? limpiar($_REQUEST["id"]) : "";
        $exito = $this->model->delete($id);
        $this->redirectWithMessage(
            $exito,
            "Publicacion eliminada exitosamente",
            "No se pudo realizar la eliminación",
            "index.php?c=publicacion&f=index"
        );
    }

    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
    }
}
