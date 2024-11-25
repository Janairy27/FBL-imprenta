<?php
/**Llamada a nuestro archivo del modelo de bajas */
require_once '../Modelo/baja.php';
require_once '../Modelo/insumo.php';
require_once '../Modelo/empleado.php';


/**Clase de bajas donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de bajas
 */
class controladorBaja{
    private $baja;
    private $insumo;
    private $empleado;

    /**Asociación a la funcion de bajas, cada que se haga uso, se estara enlazando a la 
     * funcion de bajas que se encuentra en el modelo
     */
    public function __construct(){
        $this->baja = new Baja();
        $this->insumo = new Insumo();
        $this->empleado = new Empleado();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de bajas
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como fecha baja, motivo,etc, se le especifica el 
     * parametro a recibir
     */
    public function listarBajas(){
        return $this->baja->obtenerBajas();
    }

    public function crearBaja($cantidad,$fechabaja,$motivo, $idinsumos, $idempleado){
        return $this->baja->agregarBaja($cantidad,$fechabaja,$motivo, $idinsumos, $idempleado);
    }

    public function buscarBajas($busqueda, $valor){
        return $this->baja->buscarBajaPorCriterio($busqueda, $valor);
    }

    public function actualizarBaja($id, $cantidad,$fechabaja,$motivo, $idinsumos, $idempleado){
        return $this->baja->actualizarBaja($id, $cantidad,$fechabaja,$motivo, $idinsumos, $idempleado);
    }

    public function eliminarBaja($id){
        return $this->baja->eliminarBaja($id);
    }

    public function obtenerBajaID($id){
        return $this->baja->obtenerBajaID($id);
    }


    /**Funcion para obtener la lista de las bajas*/
    public function obtenerInsumos(){
        return $this->insumo->obtenerInsumoID();
    }

    public function obtenerListaInsumos(){
        return $this->insumo->obtenerInsumosparaBajas();
    }

    public function obtenerEmpleados(){
        return $this->empleado->obtenerEmpleadoID();
    }

    public function obtenerListaEmpleados(){
        return $this->empleado->obtenerEmpleadosparaBajas();
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarBajas($busqueda, $valor);
            include '../Vista/buscarBaja.php';
        }
    }


    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                $cantidad = $_POST['cantBaja'];
                $fechabaja = $_POST['fechabaja'];
                $motivo = $_POST['motivo'];
                $idinsumos = $_POST['idinsumos'];
                $idempleado = $_POST['idempleado'];
                if ($cantidad <= 0) {
                    header("Location: ../Vista/registroBaja.php?error=La+cantidad+debe+ser+mayor+a+cero");
                    exit;
                }
                if(isset($_POST['id']) && !empty($_POST['id']) ){
                    $id = $_POST['id'];
                    $this->actualizarBaja($id, $cantidad,$fechabaja,$motivo, $idinsumos, $idempleado);
                }else{
                    $this->crearBaja($cantidad,$fechabaja,$motivo, $idinsumos, $idempleado);
             
                }
                
            /**Redirigir al listado de bajas*/
            header("Location: ../Vista/buscarBaja.php");
            exit;
        }
    }
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorBaja();

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
                    $baja = $controlador->obtenerBajaID($_GET['id']);
                    $insumo = $controlador->obtenerInsumos();
                    $empleado = $controlador->obtenerEmpleados();
                    include '../Vista/editarBaja.php';
                }            
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarBaja($_GET['id']);
                }
                header("Location: ../Vista/buscarBaja.php");
                break;
            default:
                header("Location: ../Vista/registroBaja.php");
                break;
        }
    }



?>