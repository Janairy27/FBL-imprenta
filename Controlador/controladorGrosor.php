<?php

/**Llamada a nuestro archivo del modelo de grosor*/
require_once '../Modelo/grosor.php';

/**Clase de empleado donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de grosor
 */
class controladorGrosor
{
    private $grosor;

    /**Asociación a la funcion de grosor, cada que se haga uso, se estara enlacando a la 
     * funcion de grosor que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->grosor = new Grosor();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de grosor
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos se le especifica el 
     * parametro a recibir
     */
    public function listarGrosores()
    {
        return $this->grosor->obtenerGrosores();
    }

    public function crearGrosor($cantGrosor, $unidadMedida, $flexibilidad)
    {
        return $this->grosor->agregaGrosor($cantGrosor, $unidadMedida, $flexibilidad);
    }

    public function buscarGrosores($busqueda, $valor)
    {
        return $this->grosor->buscarGrosorPorCriterio($busqueda, $valor);
    }

    public function actualizarGrosor($id, $cantGrosor, $unidadMedida, $flexibilidad)
    {
        return $this->grosor->actualizarGrosor($id, $cantGrosor, $unidadMedida, $flexibilidad);
    }

    public function eliminarGrosor($id)
    {
        return $this->grosor->eliminarGrosor($id);
    }

    public function obtenerGrosorID($id)
    {
        return $this->grosor->obtenerGrosorID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarGrosores($busqueda, $valor);
            include '../Vista/buscarGrosor.php';
        }
    }
    /**Validacion   degrosor */
    public function validarGrosor($cantGrosor, $unidadMedida, $flexibilidad)
    {
        return $this->grosor->validarGrosor($cantGrosor, $unidadMedida, $flexibilidad);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cantGrosor = $_POST['cantGrosor'];
            $unidadMedida = $_POST['unidadMedida'];
            $flexibilidad = $_POST['flexibilidad'];
            $id = isset($_POST['id']) ? $_POST['id'] : null;


            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarGrosor($cantGrosor, $unidadMedida, $flexibilidad)) {
                    header("Location: ../Controlador/controladorGrosor.php?accion=actualizar&id=$id&error=Grosor+existente");
                    exit;
                }

                $this->actualizarGrosor($id, $cantGrosor, $unidadMedida, $flexibilidad);
            } else {
                if ($this->validarGrosor($cantGrosor, $unidadMedida, $flexibilidad)) {
                    header("Location: ../Vista/registroGrosor.php?error=Grosor+ya+existente");
                    exit;
                }

                /**Se llama a la funcion de crear el empleado */
                $this->crearGrosor($cantGrosor, $unidadMedida, $flexibilidad);
            }

            /**Redirigir al listado de grosor*/
            header("Location: ../Vista/buscarGrosor.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorGrosor();

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
                $grosor = $controlador->obtenerGrosorID($_GET['id']);
                include '../Vista/editarGrosor.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarGrosor($_GET['id']);
            }
            header("Location: ../Vista/buscarGrosor.php");
            break;
        default:
            header("Location: ../Vista/registroGrosor.php");
            break;
    }
}
