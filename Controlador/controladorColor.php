<?php
/**Llamada a nuestro archivo del modelo de colores */
require_once '../Modelo/color.php';

/**Clase de colores donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de colores
 */
class controladorColor{
    private $color;

    /**Asociación a la funcion de colores, cada que se haga uso, se estara enlacando a la 
     * funcion de colores que se encuentra en el modelo
     */
    public function __construct(){
        $this->color= new Color();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de colores
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarColores(){
        return $this->color->obtenerColores();
    }

    public function crearColor($nombre){
        return $this->color->agregaColor($nombre);
    }

    public function buscarColores($busqueda, $valor){
        return $this->color->buscarColorPorCriterio($busqueda, $valor);
    }

    public function actualizarColor($id, $nombre){
        return $this->color->actualizarColor($id, $nombre);
    }

    public function eliminarColor($id){
        return $this->color->eliminarColor($id);
    }

    public function obtenerColorID($id){
        return $this->color->obtenerColorID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarColores($busqueda, $valor);
            include '../Vista/buscarColor.php';
        }
    }
    /**Validaciones de color  */
    public function validarColor($color){
        return $this->color->obtenerColor($color);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;
            
            
            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                if($this->validarColor($nombre)){
                    header("Location: ../Controlador/controladorColor.php?accion=actualizar&id=$id&error=Color+existente");
                    exit;
                    
                }
    
                $this->actualizarColor($id, $nombre);
            }else{

                if($this->validarColor($nombre)){
                    header("Location: ../Vista/registroColor.php?error=El+color+ya+es+existente");
                    exit;
                    
                }
    
                /**Se llama a la funcion de crear el colore */
                $this->crearColor($nombre );
        
            }
            
            /**Redirigir al listado de colores*/
            header("Location: ../Vista/buscarColor.php");
            exit;
        }
    }
    
        
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorColor();

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
                    $color = $controlador->obtenerColorID($_GET['id']);
                    include '../Vista/editarColor.php';
                }  
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarColor($_GET['id']);
                }
                header("Location: ../Vista/buscarColor.php");
                break;
            default:
                header("Location: ../Vista/registroColor.php");
                break;
        }
    }