<?php

/**Llamada a nuestro archivo del modelo de submaterial */
require_once '../Modelo/tipomaterial.php';

/**Clase de submaterial donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de submaterial
 */
class controladorSubMaterial
{
    private $submaterial;

    /**Asociación a la funcion de submaterial, cada que se haga uso, se estara enlacando a la 
     * funcion de submaterial que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->submaterial = new Tipomaterial();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de submaterial
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos,  se le especifica el 
     * parametro a recibir
     */
    public function listarSubMateriales()
    {
        return $this->submaterial->obtenerSubMateriales();
    }

    public function crearSubmaterial($nombre)
    {
        return $this->submaterial->agregaSubMaterial($nombre);
    }

    public function buscarSubMateriales($busqueda, $valor)
    {
        return $this->submaterial->buscarSubMaterialPorCriterio($busqueda, $valor);
    }

    public function actualizarSubMaterial($id, $nombre)
    {
        return $this->submaterial->actualizarSubMaterial($id, $nombre);
    }

    public function eliminarSubMaterial($id)
    {
        return $this->submaterial->eliminarSubMaterial($id);
    }

    public function obtenerSubMaterialID($id)
    {
        return $this->submaterial->obtenerSubMaterialID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarSubMateriales($busqueda, $valor);
            include '../Vista/buscarSubMaterial.php';
        }
    }
    /**Validaciones de submaterial */
    public function validarSubMaterial($submaterial)
    {
        return $this->submaterial->obtenerSubMaterial($submaterial);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;



            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarSubMaterial($nombre)) {
                    // Redirigir con el mensaje de error en la URL

                    header("Location: ../Controlador/controladorSubMaterial.php?accion=actualizar&id=$id&error=SubMaterial+existente");
                    exit;
                }

                $this->actualizarSubMaterial($id, $nombre);
            } else {
                if ($this->validarSubMaterial($nombre)) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registrarSubMaterial.php?error=Submaterial+ya+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el submaterial */
                $this->crearSubmaterial($nombre);
            }

            /**Redirigir al listado de submaterial*/
            header("Location: ../Vista/buscarSubMaterial.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorSubMaterial();

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
                $marca = $controlador->obtenerSubMaterialID($_GET['id']);
                include '../Vista/editarSubMaterial.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarSubMaterial($_GET['id']);
            }
            header("Location: ../Vista/buscarSubMaterial.php");
            break;
        default:
            header("Location: ../Vista/registrarSubMaterial.php");
            break;
    }
}
