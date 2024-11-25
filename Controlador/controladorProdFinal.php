<?php
/**Llamada a nuestro archivo del modelo de productos finales */
require_once '../Modelo/modeloProdFinal.php';

/**Clase de productos donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de productos finales
 */
class controladorProdFinal{
    private $productoF;

    /**Asociación a la funcion de productos finales, cada que se haga uso, se estara enlacando a la 
     * funcion de producto final que se encuentra en el modelo
     */
    public function __construct(){
        $this->productoF = new ProdFinal();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de productos finales
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como id, nombre, etc., se le especifica el 
     * parametro a recibir
     */
    public function listarProdFinal(){
        return $this->productoF->obtenerProducto();
    }

    public function crearProdFinal($nombre, $precio){
        return $this->productoF->agregarProducto($nombre, $precio);
    }

    public function buscarProdFinal($busqueda, $valor){
        return $this->productoF->buscarProductoPorCriterio($busqueda, $valor);
    }

    public function actualizarProdFinal($id, $nombre, $precio){
        return $this->productoF->actualizarProducto($id, $nombre, $precio);
    }

    public function eliminarProdFinal($id){
        return $this->productoF->eliminarProducto($id);
    }

    public function obtenerProdFinalID($id){
        return $this->productoF->obtenerProductoID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarProdFinal($busqueda, $valor);
            include '../Vista/ProdFinal.php';
        }
    }

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $this->actualizarProdFinal($id, $nombre, $precio);
            }else{
                /**Se llama a la funcion de crear el producto final */
                $this->crearProdFinal($nombre, $precio);
        
            }
            
            /**Redirigir al listado de productos*/
            header("Location: ../Vista/ProdFinal.php");
            exit;
        }
    }
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorProdFinal();

        /**Menú de opciones que se quieran realizar */
        switch($_GET['accion']){
            case 'crear':
                $controlador->procesarDatos();
                break;
            case 'buscar':
                $controlador->procesarBusqueda();
                break;
            case 'actualizar':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $controlador->procesarDatos();
                }elseif(isset($_GET['id'])){
                    $productoF = $controlador->obtenerProdFinalID($_GET['id']);
                    include '../Vista/editarProdFinal.php';
                }              
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarProdFinal($_GET['id']);
                }
                header("Location: ../Vista/ProdFinal.php");
                break;
            default:
                header("Location: ../Vista/registroProdFinal.php");
                break;
        }
    }

?>