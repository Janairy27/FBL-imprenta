<?php
/**Llamada a nuestro archivo del modelo de presentacion */
require_once '../Modelo/presentacion.php';

/**Clase de  presentacion  donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de  presentacion 
 */
class controladorPresentacion{
    private $presentacion;

    /**Asociación a la funcion de  presentacion , cada que se haga uso, se estara enlacando a la 
     * funcion de  presentacion  que se encuentra en el modelo
     */
    public function __construct(){
        $this->presentacion= new Presentacion();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de  presentacion 
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos,  se le especifica el 
     * parametro a recibir
     */
    public function listarPresentaciones(){
        return $this->presentacion->obtenerPresentaciones();
    }

    public function crearPresentacion($nombre){
        return $this->presentacion->agregaPresentacion($nombre);
    }

    public function buscarPresentaciones($busqueda, $valor){
        return $this->presentacion->buscarPresentacionPorCriterio($busqueda, $valor);
    }

    public function actualizarPresentacion($id, $nombre){
        return $this->presentacion->actualizarPresentacion($id, $nombre);
    }

    public function eliminarPresentacion($id){
        return $this->presentacion->eliminarPresentacion($id);
    }

    public function obtenerPresentacionID($id){
        return $this->presentacion->obtenerPresentacionID($id);
    }

    
    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarPresentaciones($busqueda, $valor);
            include '../Vista/buscarPresentacion.php';
        }
    }
    /**Validaciones de  presentacion  */
    public function validarPresentacion($presentacion){
        return $this->presentacion->obtenerPresentacion($presentacion);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;

            if ($this->validarPresentacion($nombre)) {
                // Redirigir con el mensaje de error en la URL
                header("Location: ../Vista/registroPresentacion.php?error=Presentacion+ya+existente");
                exit;
            }
            
            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $this->actualizarPresentacion($id, $nombre);
            }else{
                /**Se llama a la funcion de crear  presentacion  */
                $this->crearPresentacion($nombre );
        
            }
            
            /**Redirigir al listado de  presentacion */
            header("Location: ../Vista/buscarPresentacion.php");
            exit;
        }
    }
    
        
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorPresentacion();

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
                    $presentacion = $controlador->obtenerPresentacionID($_GET['id']);
                    include '../Vista/editarPresentacion.php';
                }  
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarPresentacion($_GET['id']);
                }
                header("Location: ../Vista/buscarPresentacion.php");
                break;
            default:
                header("Location: ../Vista/registrarPresentacion.php");
                break;
        }
    }