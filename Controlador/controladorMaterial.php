<?php

/**Llamada a nuestro archivo del modelo de material */
require_once '../Modelo/material.php';

/**Clase de material  donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de material 
 */
class controladorMaterial
{
    private $material;

    /**Asociación a la funcion de material , cada que se haga uso, se estara enlacando a la 
     * funcion de material  que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->material = new Material();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de material 
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarMateriales()
    {
        return $this->material->obtenerMateriales();
    }

    public function crearMaterial($nombre)
    {
        return $this->material->agregaMaterial($nombre);
    }

    public function buscarMateriales($busqueda, $valor)
    {
        return $this->material->buscarMaterialPorCriterio($busqueda, $valor);
    }

    public function actualizarMaterial($id, $nombre)
    {
        return $this->material->actualizarMaterial($id, $nombre);
    }

    public function eliminarMaterial($id)
    {
        return $this->material->eliminarMaterial($id);
    }

    public function obtenerMaterialID($id)
    {
        return $this->material->obtenerMaterialID($id);
    }

    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarMateriales($busqueda, $valor);
            include '../Vista/buscarMaterial.php';
        }
    }
    /**Validaciones de material  */
    public function validarMaterial($material)
    {
        return $this->material->obtenerMaterial($material);
    }



    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];

            $id = isset($_POST['id']) ? $_POST['id'] : null;




            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->validarMaterial($nombre)) {

                    header("Location: ../Controlador/controladorMaterial.php?accion=actualizar&id=$id&error=Material+existente");
                    exit;
                }
                $this->actualizarMaterial($id, $nombre);
            } else {
                if ($this->validarMaterial($nombre)) {
                    header("Location: ../Vista/registrarMaterial.php?error=Material+ya+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el material  */
                $this->crearMaterial($nombre);
            }

            /**Redirigir al listado de material */
            header("Location: ../Vista/buscarMaterial.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorMaterial();

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
                $material = $controlador->obtenerMaterialID($_GET['id']);
                include '../Vista/editarMaterial.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarMaterial($_GET['id']);
            }
            header("Location: ../Vista/buscarMaterial.php");
            break;
        default:
            header("Location: ../Vista/registrarMaterial.php");
            break;
    }
}
