<?php
/**Llamada a nuestro archivo del modelo de empleados */
require_once '../Modelo/empleado.php';

/**Clase de empleado donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de empleados
 */
class controladorEmpleado{
    private $empleado;

    /**Asociación a la funcion de empleado, cada que se haga uso, se estara enlacando a la 
     * funcion de empleado que se encuentra en el modelo
     */
    public function __construct(){
        $this->empleado = new Empleado();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de empleados
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como id, nombre, etc., se le especifica el 
     * parametro a recibir
     */
    public function listarEmpleados(){
        return $this->empleado->obtenerEmpleados();
    }

    public function crearEmpleado($nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol){
        return $this->empleado->agregarEmpleado($nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol);
    }

    public function buscarEmpleados($busqueda, $valor){
        return $this->empleado->buscarEmpleadoPorCriterio($busqueda, $valor);
    }

    public function actualizarEmpleado($id, $nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol){
        return $this->empleado->actualizarEmpleado($id, $nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol);
    }

    public function eliminarEmpleado($id){
        return $this->empleado->eliminarEmpleado($id);
    }

    public function obtenerEmpleadoID($id){
        return $this->empleado->obtenerEmpleadoID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarEmpleados($busqueda, $valor);
            include '../Vista/buscarEmpleado.php';
        }
    }
    /**Validaciones de correo, telefono y rol empresarial */
    public function validarTelefono($tel){
        return $this->empleado->obtenerTelefono($tel);
    }

    public function validarCorreo($corr){
        return $this->empleado->obtenerCorreo($corr);
    }


    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = $_POST['nombre'];
            $apaterno = $_POST['apaterno'];
            $amaterno = $_POST['amaterno'];
            $fecha = $_POST['nacimiento'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;
            
            if($this->validarTelefono($telefono)){
                header("Location: ../Vista/registroEmpleado.php?error=Número+de+telefono+existente");
                exit;
            }
            $correo = $_POST['correo'];
            if($this->validarCorreo($correo)){
                header("Location: ../Vista/registroEmpleado.php?error=Correo+electronico+existente");
                exit;
            }
            $rol = $_POST['rol'];
            if(!($rol =='Empleado' || $rol =='Representante' || $rol == 'Practicante')){
                header("Location: ../Vista/registroEmpleado.php?error=El+rol+es+incorrecto,+debe+de,+ser+Empleado+o+Practicante");
                exit;
            }

            if(isset($_POST['id']) && !empty($_POST['id']) ){
                $id = $_POST['id'];
                $this->actualizarEmpleado($id, $nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol);
            }else{
                /**Se llama a la funcion de crear el empleado */
                $this->crearEmpleado($nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol);
        
            }
            
            /**Redirigir al listado de empleados*/
            header("Location: ../Vista/buscarEmpleado.php");
            exit;
        }
    }
    
        
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorEmpleado();

        /**Menú de opciones que se quieran realizar */
        switch($_GET['accion']){
            case 'crear':
                $controlador->procesarDatos();
                /*header("Location: ../Vista/registroEmpleado.php");*/
                break;
            case 'buscar':
                $controlador->procesarBusqueda();
                break;
            case 'actualizar':
                //$controlador->procesarDatos();
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $controlador->procesarDatos();
                }elseif(isset($_GET['id'])){
                    $empleado = $controlador->obtenerEmpleadoID($_GET['id']);
                    include '../Vista/editarEmpleado.php';
                }  
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarEmpleado($_GET['id']);
                }
                header("Location: ../Vista/buscarEmpleado.php");
                break;
            default:
                header("Location: ../Vista/registroEmpleado.php");
                break;
        }
    }








