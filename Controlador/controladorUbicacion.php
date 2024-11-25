<?php

/**Llamada a nuestro archivo del modelo de ubicacion */
require_once('../Modelo/ubicacion.php');


/**Clase de ubicacion donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de ubicacion
 */
class controladorUbicacion
{
    private $ubicacion;

    /**Asociación a la funcion de ubicacion, cada que se haga uso, se estara enlacando a la 
     * funcion de ubicacion que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->ubicacion = new Ubicacion();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de ubicacion
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarUbicaciones()
    {
        return $this->ubicacion->obtenerUbicaciones();
    }

    public function crearUbicacion($mueble, $division1, $division2, $division3)
    {
        return $this->ubicacion->agregarUbicacion($mueble, $division1, $division2, $division3);
    }

    public function buscarUbicaciones($busqueda, $valor)
    {
        return $this->ubicacion->buscarUbicacionPorCriterio($busqueda, $valor);
    }

    public function actualizarUbicacion($id, $mueble, $division1, $division2, $division3)
    {
        return $this->ubicacion->actualizarUbicacion($id, $mueble, $division1, $division2, $division3);
    }

    public function eliminarUbicacion($id)
    {
        return $this->ubicacion->eliminarUbicacion($id);
    }

    public function obtenerUbicacionID($id)
    {
        return $this->ubicacion->obtenerUbicacionID($id);
    }
    public function validarUbicacion($mueble, $division1, $division2, $division3)
    {
        return $this->ubicacion->validarUbicacion($mueble, $division1, $division2, $division3);
    }
    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarUbicaciones($busqueda, $valor);
            include '../Vista/buscarUbicacion.php';
        }
    }


    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mueble = $_POST['mueble'];
            $division1 = $_POST['division1'];
            $division2 = $_POST['division2'];
            $division3 = $_POST['division3'];
            $id = isset($_POST['id']) ? $_POST['id'] : null;



            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->ubicacion->validarUbicacion($mueble, $division1, $division2, $division3)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Controlador/controladorUbicacaion.php?accion=actualizar&id=$id&error=Ubicacion+existente");
                    exit;
                }
                $this->actualizarUbicacion($id, $mueble, $division1, $division2, $division3);
            } else {
                if ($this->ubicacion->validarUbicacion($mueble, $division1, $division2, $division3)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroUbicacion.php?error=" . urlencode("Ubicación ya existente"));
                    exit;
                }
                /**Se llama a la funcion de crear el ubicacion */
                $this->crearUbicacion($mueble, $division1, $division2, $division3);
            }

            /**Redirigir al listado de ubicacion*/
            header("Location: ../Vista/buscarUbicacion.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorUbicacion();

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
                $ubicacion = $controlador->obtenerUbicacionID($_GET['id']);
                include '../Vista/editarUbicacion.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarUbicacion($_GET['id']);
            }
            header("Location: ../Vista/buscarUbicacion.php");
            break;
        default:
            header("Location: ../Vista/registroUbicacion.php");
            break;
    }
}
