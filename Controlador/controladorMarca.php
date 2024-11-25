<?php
/**Llamada a nuestro archivo del modelo de marca */
require_once '../Modelo/marca.php';

/**Clase de marca donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de marca
 */
class controladorMarca{
    private $marca;

    /**Asociación a la funcion de marca, cada que se haga uso, se estara enlacando a la 
     * funcion de marca que se encuentra en el modelo
     */
    public function __construct(){
        $this->marca= new Marca();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de marca
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarMarcas(){
        return $this->marca->obtenerMarcas();
    }

    public function crearMarca($nombre,$descripcion){
        return $this->marca->agregaMarca($nombre,$descripcion);
    }

    public function buscarMarcas($busqueda, $valor){
        return $this->marca->buscarMarcaPorCriterio($busqueda, $valor);
    }

    public function actualizarMarca($id, $nombre,$descripcion){
        return $this->marca->actualizarMarca($id, $nombre,$descripcion);
    }

    public function eliminarMarca($id){
        return $this->marca->eliminarMarca($id);
    }

    public function obtenerMarcaID($id){
        return $this->marca->obtenerMarcaID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarMarcas($busqueda, $valor);
            include '../Vista/buscarMarca.php';
        }
    }
    /**Validaciones de marca*/
    public function validarMarca($marca){
        return $this->marca->obtenerMarca($marca);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            
            if($this->validarMarca($nombre)){
                header("Location: ../Vista/registrarMarca.php?error=Marca+ya+existente");
                exit;
            }
          

            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $this->actualizarMarca($id, $nombre,$descripcion);
            }else{
                $this->crearMarca($nombre, $descripcion);
        
            }
            
            header("Location: ../Vista/buscarMarca.php");
            exit;
        }
    }
    
        
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorMarca();

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
                    $marca = $controlador->obtenerMarcaID($_GET['id']);
                    include '../Vista/editarMarca.php';
                }  
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarMarca($_GET['id']);
                }
                header("Location: ../Vista/buscarMarca.php");
                break;
            default:
                header("Location: ../Vista/registrarMarca.php");
                break;
        }
    }