<?php

/**Llamada a nuestro archivo del modelo de tipo de medida */
require_once '../Modelo/tipoMedida.php';

/**Clase de tipo de medida donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de tipo de medida
 */
class controladorTipoMedida
{
    private $tipomedida;

    /**Asociación a la funcion de tipo de medida, cada que se haga uso, se estara enlacando a la 
     * funcion de tipo de medida que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->tipomedida = new TipoMedida();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de tipo de medida
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos,  se le especifica el 
     * parametro a recibir
     */
    public function listarTiposMedidas()
    {
        return $this->tipomedida->obtenerTiposMedidas();
    }

    public function crearTipoMedida($nombre, $unidad)
    {
        return $this->tipomedida->agregaTipoMedida($nombre, $unidad);
    }

    public function buscarTiposMedidas($busqueda, $valor)
    {
        return $this->tipomedida->buscarTipoMedidaPorCriterio($busqueda, $valor);
    }

    public function actualizarTipoMedida($id, $nombre, $unidad)
    {
        return $this->tipomedida->actualizarTipoMedida($id, $nombre,  $unidad);
    }

    public function eliminarTipoMedida($id)
    {
        return $this->tipomedida->eliminarTipoMedida($id);
    }

    public function obtenerTipoMedidaID($id)
    {
        return $this->tipomedida->obtenerTipoMedidaID($id);
    }
    public function validarTiopoMedida($tipomedida, $unidad)
    {
        return $this->tipomedida->validarTipoMedida($tipomedida, $unidad);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarTiposMedidas($busqueda, $valor);
            include '../Vista/buscarTipoMedida.php';
        }
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombreT'];
            $unidad = $_POST['unidad'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;





            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->tipomedida->validarTipoMedida($nombre, $unidad)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Controlador/controladorTipoMedida.php?accion=actualizar&id=$id&error=Tipo+de+medida+existente");
                    exit;
                }
                $this->actualizarTipoMedida($id, $nombre,  $unidad,);
            } else {
                if ($this->tipomedida->validarTipoMedida($nombre, $unidad)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroTipoMedida.php?error=Tipo+de+medida+ya+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el tipo de medida */
                $this->crearTipoMedida($nombre, $unidad,);
            }

            /**Redirigir al listado de tipo de medida*/
            header("Location: ../Vista/buscarTipoMedida.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorTipoMedida();

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
                $tipomedida = $controlador->obtenerTipoMedidaID($_GET['id']);
                include '../Vista/editarTipoMedida.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarTipoMedida($_GET['id']);
            }
            header("Location: ../Vista/buscarTipoMedida.php");
            break;
        default:
            header("Location: ../Vista/registroTipoMedida.php");
            break;
    }
}
