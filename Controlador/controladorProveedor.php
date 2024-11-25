<?php

/**Llamada a nuestro archivo del modelo de proveedor */
require_once '../Modelo/proveedor.php';

/**Clase de proveedor donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de proveedor
 */
class controladorProveedor
{
    private $proveedor;

    /**Asociación a la funcion de proveedor, cada que se haga uso, se estara enlacando a la 
     * funcion de proveedor que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->proveedor = new Proveedor();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de proveedor
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarProveedores()
    {
        return $this->proveedor->obtenerProveedores();
    }

    public function crearProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente)
    {
        return $this->proveedor->agregarProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente);
    }

    public function buscarProveedores($busqueda, $valor)
    {
        return $this->proveedor->buscarProveedorPorCriterio($busqueda, $valor);
    }

    public function actualizarProveedor($id, $nombre, $direccion, $contacto, $telefono, $correo, $numCliente)
    {
        return $this->proveedor->actualizarProveedor($id, $nombre,  $direccion, $contacto, $telefono, $correo, $numCliente);
    }

    public function eliminarProveedor($id)
    {
        return $this->proveedor->eliminarProveedor($id);
    }

    public function obtenerProveedorID($id)
    {
        return $this->proveedor->obtenerProveedorID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarProveedores($busqueda, $valor);
            include '../Vista/buscarProveedor.php';
        }
    }
    /**Validaciones de correo, telefono */
    public function validarTelefono($tel)
    {
        return $this->proveedor->validarTelefono($tel);
    }

    public function validarCorreo($corr)
    {
        return $this->proveedor->validarCorreo($corr);
    }
    public function validarProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente)
    {
        return $this->proveedor->validarProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente);
    }


    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['Nomproveedor'];
            $direccion = $_POST['direccion'];
            $contacto = $_POST['contacto'];
            $numCliente = $_POST['numCliente'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $id = isset($_POST['id']) ? $_POST['id'] : null;




            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente)) {
                    header("Location: ../Controlador/controladorProveedor.php?accion=actualizar&id=$id&error=Proveedor+existente");
                    exit;
                }
                $this->actualizarProveedor($id, $nombre,  $direccion, $contacto, $telefono, $correo, $numCliente);
            } else {
                // Validaciones
                if ($this->proveedor->validarTelefono($telefono)) {
                    header("Location: ../Vista/registrarProveedor.php?error=Telefono+existente");
                    exit;
                }

                if ($this->validarCorreo($correo)) {
                    header("Location: ../Vista/registrarProveedor.php?error=Correo+existente");
                    exit;
                }

                /**Se llama a la funcion de crear el proveedor*/
                $this->crearProveedor($nombre, $direccion, $contacto, $telefono, $correo, $numCliente);
            }

            /**Redirigir al listado de proveedor*/
            header("Location: ../Vista/buscarProveedor.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorProveedor();

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
                $proveedor = $controlador->obtenerProveedorID($_GET['id']);
                include '../Vista/editarProveedor.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarProveedor($_GET['id']);
            }
            header("Location: ../Vista/buscarProveedor.php");
            break;
        default:
            header("Location: ../Vista/registrarProveedor.php");
            break;
    }
}
