<?php

/**Llamada a nuestro archivo del modelo de estado*/
require_once '../Modelo/modeloEstado.php';

/**Clase de estado donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de estados
 */
class controladorEstado
{
    private $estado;

    /**Asociación a la funcion de estado, cada que se haga uso, se estara enlacando a la 
     * funcion de estado que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->estado = new Estado();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de estados
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como id, nombre, etc., se le especifica el 
     * parametro a recibir
     */
    public function listarEstados()
    {
        return $this->estado->obtenerEstados();
    }

    public function crearEstado($estado)
    {
        return $this->estado->agregarEstado($estado);
    }

    public function buscarEstados($busqueda, $valor)
    {
        return $this->estado->buscarEstadoPorCriterio($busqueda, $valor);
    }

    public function actualizarEstado($id, $estado)
    {
        return $this->estado->actualizarEstado($id, $estado);
    }

    public function eliminarEstado($id)
    {
        return $this->estado->eliminarEstado($id);
    }

    public function obtenerEstadoID($id)
    {
        return $this->estado->obtenerEstadoID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarEstados($busqueda, $valor);
            include '../Vista/Estado.php';
        }
    }

    /**Validaciones de estado */
    public function validarEstado($est)
    {
        return $this->estado->obtenerEstado($est);
    }

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estado = $_POST['estado'];
            $id = isset($_POST['id']) ? $_POST['id'] : null;



            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarEstado($estado)) {
                    header("Location: ../Controlador/controladorEstado.php?accion=actualizar&id=$id&error=Estado+existente");
                    exit;
                }
                $this->actualizarEstado($id, $estado);
            } else {
                if ($this->validarEstado($estado)) {
                    header("Location: ../Vista/registroEstado.php?error=Estado+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el estado */
                $this->crearEstado($estado);
            }

            /**Redirigir al listado de empleados*/
            header("Location: ../Vista/Estado.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorEstado();

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
                $estado = $controlador->obtenerEstadoID($_GET['id']);
                include '../Vista/editarEstado.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarEstado($_GET['id']);
            }
            header("Location: ../Vista/Estado.php");
            break;
        default:
            header("Location: ../Vista/registroEstado.php");
            break;
    }
}
