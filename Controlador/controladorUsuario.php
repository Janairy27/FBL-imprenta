<?php
/**Llamada a nuestro archivo del modelo de usuarios */
require_once '../Modelo/modeloUsuario.php';
require_once '../Modelo/empleado.php';


/**Clase de usuarios donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de usuarios
 */
class controladorUsuario{
    private $usuario;
    private $empleado;

    /**Asociación a la funcion de usuario, cada que se haga uso, se estara enlacando a la 
     * funcion de usuario que se encuentra en el modelo
     */
    public function __construct(){
        $this->usuario = new Usuario();
        $this->empleado = new Empleado();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de usuarios
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, como usuario, contraseña, etc., se le especifica el 
     * parametro a recibir
     */
    public function listarUsuarios(){
        return $this->usuario->obtenerUsuarios();
    }

    public function crearUsuario($usuario, $contrasena, $idempleado){
        return $this->usuario->agregarUsuario($usuario, $contrasena, $idempleado);
    }

    public function buscarUsuarios($busqueda, $valor){
        return $this->usuario->buscarUsuarioPorCriterio($busqueda, $valor);
    }

    public function actualizarUsuario($id, $usuario, $contrasena, $idempleado){
        return $this->usuario->actualizarUsuario($id, $usuario, $contrasena, $idempleado);
    }

    public function eliminarUsuario($id){
        return $this->usuario->eliminarUsuario($id);
    }

    public function obtenerUsuarioID($id){
        return $this->usuario->obtenerUsuarioID($id);
    }

    /**Funcion para obtener la lista de los empleados desde el controlador de empleados*/
    public function obtenerEmpleados(){
        return $this->empleado->obtenerEmpleadoID();
    }

    /**Función para obtener el nombre de los empleados, mostrando el nombre y apellido desde el controlador de empleados */
    public function obtenerListaEmpleados(){
        return $this->empleado->obtenerEmpleadosparaUsuarios();
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarUsuarios($busqueda, $valor);
            include '../Vista/Usuario.php';
        }
    }

    /**Función para validar que el empleado se no se encuentre registrado 
    public function validarEmpleado($ide){
        return $this->emplado->obtenerIDEmpleado($ide);
    }*/

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['idempleado'])){
                // Redirigir con el mensaje de error en la URL
                header("Location: ../Vista/registroUsuario.php?error=" . urlencode("Ubicación ya existente"));
                exit;
            }
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];
                $idempleado = $_POST['idempleado'];
              /*  if($this->validarEmpleado($idempleado)){
                    die("El empleado $idempleado ya cuenta con credenciales");
                }*/

                if(isset($_POST['id']) && !empty($_POST['id']) ){
                    $id = $_POST['id'];
                    $this->actualizarUsuario($id, $usuario, $contrasena, $idempleado);
                    //header("Location: ../Vista/Usuario.php?accion=actualizar");
                }else{
                    /**Se llama a la funcion de crear el usuario */
                    $this->crearUsuario($usuario, $contrasena, $idempleado);
                    //header("Location: ../Vista/Usuario.php?accion=crear");
                }
                
            /**Redirigir al listado de usuarios*/
            header("Location: ../Vista/Usuario.php");
            exit;
        }
    }
}


    /**Control de opciones de las funciones integradas en las vistas */
    if(isset($_GET['accion'])){
        $controlador = new controladorUsuario();

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
                    $usuario = $controlador->obtenerUsuarioID($_GET['id']);
                    $empleado = $controlador->obtenerEmpleados();
                    include '../Vista/editarUsuario.php';
                }            
                break;
            case 'eliminar':
                if(isset($_GET['id'])){
                    $controlador->eliminarUsuario($_GET['id']);
                }
                header("Location: ../Vista/Usuario.php");
                break;
            default:
                header("Location: ../Vista/registroUsuario.php");
                break;
        }
    }



?>