<?php

/**Llamada a nuestro archivo del modelo de detalle*/
require_once '../Modelo/modeloDetalle.php';
require_once '../Modelo/modelopedido.php';


/**Clase de usuarios donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de detalle
 */
class controladorDetalle
{
    private $detalle;
    private $pedido;

    /**Asociación a la funcion de detalle cada que se haga uso, se estara enlacando a la 
     * funcion de usuario que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->detalle = new Detalle();
        $this->pedido = new pedido();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de detalle
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, c se le especifica el 
     * parametro a recibir
     */
    public function listarDetalle()
    {
        return $this->detalle->obtenerDetalles();
    }

    public function crearDetalle($descuento, $subtotal, $iva, $total, $serie)
    {
        return $this->detalle->agregarDetalle($descuento, $subtotal, $iva, $total, $serie);
    }

    public function buscarDetalle($busqueda, $valor)
    {
        return $this->detalle->buscarDetallePorCriterio($busqueda, $valor);
    }

    public function actualizarDetalle($id, $descuento, $subtotal, $iva, $total, $serie)
    {
        return $this->detalle->actualizarDetalle($id, $descuento, $subtotal, $iva, $total, $serie);
    }

    public function eliminarDetalle($id)
    {
        return $this->detalle->eliminarDetalle($id);
    }

    public function obtenerDetalleID($id)
    {
        return $this->detalle->obtenerDetalleID($id);
    }

    /**Funcion para obtener la lista de los pedidos */
    public function obtenerPedidos()
    {
        return $this->pedido->obtenerPedidoID();
    }

    /*funcion para obtener los pedidos para e detalle */
    public function obtenerListaPedidos()
    {
        return $this->pedido->obtenerPedidoparaDetalle();
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarDetalle($busqueda, $valor);
            include '../Vista/Detalle.php';
        }
    }

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = isset($_POST['id']) ? $_POST['id'] : null;

            $descuento = $_POST['descuento'];
            $subtotal = $_POST['subtotal'];
            $iva = $_POST['iva'];
            $total = $_POST['total'];
            $serie = $_POST['serie'];

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $this->actualizarDetalle($id, $descuento, $subtotal, $iva, $total, $serie);
            } else {
                if (empty($_POST['descuento']) || empty($_POST['subtotal']) || empty($_POST['iva']) || empty($_POST['total']) || empty($_POST['serie'])) {
                    header("Location: ../Vista/registroDetalle.php?error=Todos+los+campos+deben+de+estar+llenos");
                    exit;
                }
                /**Se llama a la funcion de crear el detalle */
                $this->crearDetalle($descuento, $subtotal, $iva, $total, $serie);
            }

            header("Location: ../Vista/Detalle.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorDetalle();

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
                $detalle = $controlador->obtenerDetalleID($_GET['id']);
                include '../Vista/editarDetalle.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarDetalle($_GET['id']);
            }
            header("Location: ../Vista/Detalle.php");
            break;
        default:
            header("Location: ../Vista/registroDetalle.php");
            break;
    }
}
