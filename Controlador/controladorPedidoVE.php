
<?php
/**Llamada a nuestro archivo del modelo de pedido, empleado, producto final y estado */
require_once '../Modelo/modelopedido.php';
require_once '../Modelo/empleado.php';
require_once '../Modelo/modeloProdFinal.php';
require_once '../Modelo/modeloEstado.php';


class controladorPedidoVE
{
    private $pedido;
    private $productof;
    private $empleado;
    private $estado;


    public function __construct()
    {
        $this->pedido = new Pedido();
        $this->productof = new ProdFinal();
        $this->empleado = new Empleado();
        $this->estado = new Estado();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de pedidos
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como usuario, contraseña, etc., se le especifica el 
     * parametro a recibir
     */
    public function listarPedidos()
    {
        return $this->pedido->obtenerPedidos();
    }

    public function crearPedido($cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado)
    {
        return $this->pedido->agregarPedido($cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado);
    }

    public function buscarPedido($busqueda, $valor)
    {
        return $this->pedido->buscarPedidoPorCriterio($busqueda, $valor);
    }

    public function actualizarPedido($id, $cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado)
    {
        return $this->pedido->actualizarPedido($id, $cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado);
    }

    public function eliminarPedido($id)
    {
        return $this->pedido->eliminarPedido($id);
    }

    public function obtenerPedidoID($id)
    {
        return $this->pedido->obtenerPedidoID($id);
    }

    public function obtenerProductof()
    {
        return $this->productof->obtenerProductoID();
    }

    public function obtenerListaProductof()
    {
        return $this->productof->obtenerProductosFinales();
    }

    /**Funcion para obtener la lista de los empleados desde el controlador de empleados*/
    public function obtenerEmpleados()
    {
        return $this->empleado->obtenerEmpleadoID();
    }

    /**Función para obtener el nombre de los empleados, mostrando el nombre y apellido desde el controlador de empleados */
    public function obtenerListaEmpleados()
    {
        return $this->empleado->obtenerEmpleadosparaUsuarios();
    }

    public function obtenerEstados()
    {
        return $this->estado->obtenerEstadoID();
    }

    public function obtenerListaEstados()
    {
        return $this->estado->obtenerEstadosparaPedido();
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarPedido($busqueda, $valor);
            include '../Vista/PedidoVE.php';
        }
    }


    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cant = $_POST['cant'];
            $nombrecliente = $_POST['nombrecliente'];
            $fechaPedido = $_POST['fechaPedido'];
            $idproductoFinal = $_POST['idproductoFinal'];
            $idempleado = $_POST['idempleado'];
            $idestado = $_POST['idestado'];

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $this->actualizarPedido($id, $cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado);
            } else {
                $this->crearPedido($cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado);
            }

            header("Location: ../Vista/PedidoVE.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorPedidoVE();

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
                $pedido = $controlador->obtenerPedidoID($_GET['id']);

                include '../Vista/editarPedidoVE.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarPedido($_GET['id']);
            }
            header("Location: ../Vista/PedidoVE.php");
            break;
        default:
            header("Location: ../Vista/registroPedidoVE.php");
            break;
    }
}



?>