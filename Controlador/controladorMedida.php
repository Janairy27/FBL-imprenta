<?php

/**Llamada a nuestro archivo del modelo de medida */
require_once '../Modelo/medida.php';

/**Clase de emedida donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de medida
 */
class controladorMedida
{
    private $medida;

    /**Asociación a la funcion de medida, cada que se haga uso, se estara enlacando a la 
     * funcion de medida que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->medida = new Medida();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de medida
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos,  se le especifica el 
     * parametro a recibir
     */
    public function listarMedidas()
    {
        return $this->medida->obtenerMedidas();
    }

    public function crearMedida($largo, $ancho)
    {
        return $this->medida->agregaMedida($largo, $ancho);
    }

    public function buscarMedidas($busqueda, $valor)
    {
        return $this->medida->buscarMedidaPorCriterio($busqueda, $valor);
    }

    public function actualizarMedida($id, $largo, $ancho)
    {
        return $this->medida->actualizarMedida($id, $largo,  $ancho);
    }

    public function eliminarMedida($id)
    {
        return $this->medida->eliminarMedida($id);
    }

    public function obtenerMedidaID($id)
    {
        return $this->medida->obtenerMedidaID($id);
    }
    public function validarMedida($largo, $ancho)
    {
        return $this->medida->validarMedida($largo, $ancho);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarMedidas($busqueda, $valor);
            include '../Vista/buscarMedida.php';
        }
    }

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $largo = $_POST['largo'];
            $ancho = $_POST['ancho'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;


            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->medida->validarMedida($largo, $ancho)) {
                    // Redirigir con el mensaje de error en la URL


                    header("Location: ../Controlador/controladorMedida.php?accion=actualizar&id=$id&error=Medida+existente");
                    exit;
                }
                $this->actualizarMedida($id, $largo,  $ancho,);
            } else {
                if ($this->medida->validarMedida($largo, $ancho)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroMedida.php?error=Medida+ya+existente");
                    exit;
                }

                /**Se llama a la funcion de crear el medida*/
                $this->crearMedida($largo, $ancho,);
            }

            /**Redirigir al listado de medida*/
            header("Location: ../Vista/buscarMedida.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorMedida();

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
                $medida = $controlador->obtenerMedidaID($_GET['id']);
                include '../Vista/editarMedida.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarMedida($_GET['id']);
            }
            header("Location: ../Vista/buscarMedida.php");
            break;
        default:
            header("Location: ../Vista/registrarMedida.php");
            break;
    }
}