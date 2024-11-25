
<?php
/**Llamada a nuestro archivo del modelo de transparecnia */
require_once '../Modelo/transparencia.php';

/**Clase de transparecnia donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de transparecnia
 */
class controladorTransparencia
{
    private $transparencia;

    /**Asociación a la funcion de transparecnia, cada que se haga uso, se estara enlacando a la 
     * funcion de transparecnia que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->transparencia = new Transparencia();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de transparecnia
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos,  se le especifica el 
     * parametro a recibir
     */
    public function listarTransparencias()
    {
        return $this->transparencia->obtenerTransparencias();
    }

    public function crearTransparencia($nombre)
    {
        return $this->transparencia->agregarTransparencia($nombre);
    }

    public function buscarTransparencias($busqueda, $valor)
    {
        return $this->transparencia->buscarTransparenciaPorCriterio($busqueda, $valor);
    }

    public function actualizarTransparencia($id, $nombre)
    {
        return $this->transparencia->actualizarTransparencia($id, $nombre);
    }

    public function eliminarTransparencia($id)
    {
        return $this->transparencia->eliminarTransparencia($id);
    }

    public function obtenerTransparenciaID($id)
    {
        return $this->transparencia->obtenerTransparenciaID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarTransparencias($busqueda, $valor);
            include '../Vista/buscarTransparencia.php';
        }
    }
    /**Validaciones de transparecnia */
    public function validarTransparencia($transparencia)
    {
        return $this->transparencia->obtenerTransparencia($transparencia);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombreT'];
            $id = isset($_POST['id']) ? $_POST['id'] : null;



            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarTransparencia($nombre)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Controlador/controladorTransparencia.php?accion=actualizar&id=$id&error=Transparencia+existente");
                    exit;
                }
                $this->actualizarTransparencia($id, $nombre);
            } else {
                if ($this->validarTransparencia($nombre)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroTransparencia.php?error=Transparencia+ya+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el transparencia */
                $this->crearTransparencia($nombre);
            }

            /**Redirigir al listado de transparecnia*/
            header("Location: ../Vista/buscarTransparencia.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorTransparencia();

    /**Menú de opciones que se quieran realizar */
    switch ($_GET['accion']) {
        case 'crear':
            $controlador->procesarDatos();
            break;
        case 'buscar':
            $controlador->procesarBusqueda();
            break;
        case 'actualizar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controlador->procesarDatos();
            } elseif (isset($_GET['id'])) {
                $transparencia = $controlador->obtenerTransparenciaID($_GET['id']);
                include '../Vista/editarTransparencia.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarTransparencia($_GET['id']);
            }
            header("Location: ../Vista/buscarTransparencia.php");
            break;
        default:
            header("Location: ../Vista/registroTransparencia.php");
            break;
    }
}
