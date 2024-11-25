<?php
require_once '../Modelo/modeloInsumoProducto.php';
require_once '../Modelo/modeloProdFinal.php';
require_once '../Modelo/insumo.php';

class controladorInsumoProd{
    /**DEfinción de variables para poder hacer uso de ellas */
    private $productoin;
    private $productof;
    private $insumo;

    /**Función que corresponde a la asignación de información de cada una de las variables, en donde se hace uso de 
     * su respectiva asignación del modelo para poder acceder a información necesaria para realizar y 
     * mostrar datos al usuario
     */
    public function __construct(){
        $this->productoin = new ProductoIn();
        $this->productof = new ProdFinal();
        $this->insumo = new Insumo();
    }

    public function listarprodInusmo(){
        return $this->productoin->obtenerProductosIn();
    }

    public function crearInProducto($idproductoFinal, $idinsumo, $cantidad, $medida){
        return $this->productoin->agregarProductoIn($idproductoFinal, $idinsumo, $cantidad, $medida);
    }

    public function buscarprodIn($busqueda, $valor){
        return $this->productoin->buscarProductoInPorCriterio($busqueda, $valor);
    }

    public function actualizarInProducto($id, $idproductoFinal, $idinsumo, $cantidad, $medida){
        return $this->productoin->actualizarProdInsumo($id, $idproductoFinal, $idinsumo, $cantidad, $medida);
    }

    public function eliminarInProducto($id){
        return $this->productoin->eliminarProdInsumo($id);
    }

    public function obtenerInProductoID($id){
        return $this->productoin->obtenerProdInsumoID($id);
    }

    public function obtenerListaProductof(){
        return $this->productof->obtenerProductosFinales();
    }

    public function obtenerInsumoID(){
        return $this->insumo->obtenerInsumoIDparaProd();
    }

    public function obtenerListaInsumoProd(){
        return $this->insumo->obtenerInsumosparaProd();
    }
    

    /**Función para obtener los datos de la busqueda y asignarle nuestra función de busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarprodIn($busqueda, $valor);
            include '../Vista/insumoProducto.php';
        }
    }


    /**Funcion para procesar los datos recibidos del formulario, en donde se observará si el id no se 
     * encuentra registrado, esto será necesario para poder definir el proceso que se llevará acabo, 
     * ver si es una ingreso de un nuevo registro o una actualización
    */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $idproductoFinal = $_POST['idproductoFinal'];
            $idinsumo = $_POST['idinsumos'];
            $cantidad = $_POST['cantidadInsumo'];
            $medida = $_POST['medidaProducto']; 
            
            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $this->actualizarInProducto($id, $idproductoFinal, $idinsumo, $cantidad, $medida);
            }else{
                $this->crearInProducto($idproductoFinal, $idinsumo, $cantidad, $medida);
        
            }
            
            header("Location: ../Vista/insumoProducto.php");
            exit;
        }
    }
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorInsumoProd();

        /**Menú de opciones que se quieran realizar dependiendo de la información enviada desde el 
         * formulario
         */
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
                    $productoin = $controlador->obtenerInProductoID($_GET['id']);
                    include '../Vista/insumoProducto.php';
                }              
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarInProducto($_GET['id']);
                }
                header("Location: ../Vista/insumoProducto.php");
                break;
            default:
                header("Location: ../Vista/insumoProducto.php");
                break;
        }
    }


?>