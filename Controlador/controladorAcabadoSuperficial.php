<?php
/**Llamada a nuestro archivo del modelo de acabado */
require_once '../Modelo/acabadoSuperficial.php';

/**Clase de acabado donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de acabado 
 */
class controladorAcabadoSuperficial{
    private $acabado;

    /**Asociación a la funcion de acabado, cada que se haga uso, se estara enlazando a la 
     * funcion de acabado que se encuentra en el modelo
     */
    public function __construct(){
        $this->acabado= new AcabadoSuperficial();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de acabado
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hará uso, en caso de requerir parametos, como id, tipo de acabado, se le especifica el 
     * parametro a recibir
     */
    public function listarAcabados(){
        return $this->acabado->obtenerAcabados();
    }

    public function crearAcabado($nombre){
        return $this->acabado->agregaAcabado($nombre);
    }

    public function buscarAcabados($busqueda, $valor){
        return $this->acabado->buscarAcabadoPorCriterio($busqueda, $valor);
    }

    public function actualizarAcabado($id, $nombre){
        return $this->acabado->actualizarAcabado($id, $nombre);
    }

    public function eliminarAcabado($id){
        return $this->acabado->eliminarAcabado($id);
    }

    public function obtenerAcabadoID($id){
        return $this->acabado->obtenerAcabadoID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarAcabados($busqueda, $valor);
            include '../Vista/buscarAcabadoSuperficial.php';
        }
    }
    /**Validacion de acabado */
    public function validarAcabado($acabado){
        return $this->acabado->validarAcabado($acabado);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombreA'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;


            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                if ($this->acabado->validarAcabado($nombre)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Controlador/controladorAcabadoSuperficial.php?accion=actualizar&id=$id&error=Acabado+Superficial+existente");
                    exit;
                }
                $this->actualizarAcabado($id, $nombre);
            }else{

                if ($this->acabado->validarAcabado($nombre)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroAcabadoSuperficial.php?error=El+acabado+ya+es+existente");
                    exit;
                }

                /**Se llama a la funcion de crear el acabado */
                $this->crearAcabado($nombre );
        
            }
            
            /**Redirigir al listado de acabados*/
            header("Location: ../Vista/buscarAcabadoSuperficial.php");
            exit;
        }
    }
    
        
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorAcabadoSuperficial();

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
                    $acabado = $controlador->obtenerAcabadoID($_GET['id']);
                    include '../Vista/editarAcabadoSuperficial.php';
                }  
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarAcabado($_GET['id']);
                }
                header("Location: ../Vista/buscarAcabadoSuperficial.php");
                break;
            default:
                header("Location: ../Vista/registroAcabadoSuperficial.php");
                break;
        }
    }