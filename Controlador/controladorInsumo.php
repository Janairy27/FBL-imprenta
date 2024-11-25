<?php

/**Llamada a nuestro archivo del modelo de insumos */
require_once '../Modelo/insumo.php';
require_once '../Modelo/acabadoSuperficial.php';
require_once '../Modelo/color.php';
require_once '../Modelo/grosor.php';
require_once '../Modelo/marca.php';
require_once '../Modelo/material.php';
require_once '../Modelo/medida.php';
require_once '../Modelo/presentacion.php';
require_once '../Modelo/proveedor.php';
require_once '../Modelo/tipomaterial.php';
require_once '../Modelo/tipoMedida.php';
require_once '../Modelo/transparencia.php';
require_once '../Modelo/ubicacion.php';


/**Clase de insumos donde se haran las llamadas a todas las funciones integradas 
 * en el modelo de insumos
 */
class controladorInsumo
{
    private $insumo;
    private $acabado;
    private $color;
    private $grosor;
    private $marca;
    private $material;
    private $medida;
    private $presentacion;
    private $proveedor;
    private $tipomaterial;
    private $tipomedida;
    private $transparencia;
    private $ubicacion;

    /**Asociación a la funcion de  insumos, cada que se haga uso, se estara enlazando a la 
     * funcion de usuario que se encuentra en el modelo
     */
    public function __construct()
    {
        $this->insumo = new Insumo();
        $this->acabado = new AcabadoSuperficial();
        $this->color = new Color();
        $this->grosor = new Grosor();
        $this->marca = new Marca();
        $this->material = new Material();
        $this->medida = new Medida();
        $this->presentacion = new Presentacion();
        $this->proveedor = new Proveedor();
        $this->tipomaterial = new Tipomaterial();
        $this->tipomedida = new TipoMedida();
        $this->transparencia = new Transparencia();
        $this->ubicacion = new Ubicacion();
    }

    /**Funciones para hacer uso de las funcionalidades integradas en el modelo de insumos
     * se hace referencia a nuestro archivo del modelo y de ahí se expecifica hacia que funcion se
     * hara uso, en caso de requerir parametos, se le especifica el 
     * parametro a recibir
     */
    public function listarInsumos()
    {
        return $this->insumo->obtenerInsumos();
    }

    public function crearInsumo(
        $nomInsumo,
        $fechacompra,
        $fechauso,
        $cantidad,
        $rendimiento,
        $precio,
        $disponibilidad,
        $idubicacion,
        $idcolor,
        $idtransparencia,
        $idacabado,
        $idpresentacion,
        $idtipomedida,
        $idmedida,
        $idgrosor,
        $idmaterial,
        $idproveedor,
        $idmarca,
        $idsubmaterial
    ) {
        return $this->insumo->agregarInsumo(
            $nomInsumo,
            $fechacompra,
            $fechauso,
            $cantidad,
            $rendimiento,
            $precio,
            $disponibilidad,
            $idubicacion,
            $idcolor,
            $idtransparencia,
            $idacabado,
            $idpresentacion,
            $idtipomedida,
            $idmedida,
            $idgrosor,
            $idmaterial,
            $idproveedor,
            $idmarca,
            $idsubmaterial
        );
    }

    public function buscarInsumos($busqueda, $valor)
    {
        return $this->insumo->buscarInsumoPorCriterio($busqueda, $valor);
    }

    public function actualizarInsumo(
        $id,
        $nomInsumo,
        $fechacompra,
        $fechauso,
        $cantidad,
        $rendimiento,
        $precio,
        $disponibilidad,
        $idubicacion,
        $idcolor,
        $idtransparencia,
        $idacabado,
        $idpresentacion,
        $idtipomedida,
        $idmedida,
        $idgrosor,
        $idmaterial,
        $idproveedor,
        $idmarca,
        $idsubmaterial
    ) {
        return $this->insumo->actualizarInsumo(
            $id,
            $nomInsumo,
            $fechacompra,
            $fechauso,
            $cantidad,
            $rendimiento,
            $precio,
            $disponibilidad,
            $idubicacion,
            $idcolor,
            $idtransparencia,
            $idacabado,
            $idpresentacion,
            $idtipomedida,
            $idmedida,
            $idgrosor,
            $idmaterial,
            $idproveedor,
            $idmarca,
            $idsubmaterial
        );
    }

    public function eliminarInsumo($id)
    {
        return $this->insumo->eliminarInsumo($id);
    }

    public function obtenerInsumosID($id)
    {
        return $this->insumo->obtenerInsumoID($id);
    }

    /**Función para obtener el id del acabado desde el controlador de acabados */
    public function obtenerAcabados()
    {
        return $this->acabado->obtenerAcabadoID();
    }


    /**Funcion para obtener la lista de los ACABADOS desde el controlador de ACABADO*/
    public function obtenerListaAcabados()
    {
        return $this->acabado->obtenerAcabadoparaInsumos();
    }
    /**Función para obtener el id del colores desde el controlador de colores */
    public function obtenerColores()
    {
        return $this->color->obtenerColorID();
    }

    /**Función para obtener la lista del colores desde el controlador de colores */
    public function obtenerListaColores()
    {
        return $this->color->obtenerColorparaInsumos();
    }
    /**Función para obtener el id del colores desde el controlador de colores */
    public function obtenerGrosores()
    {
        return $this->grosor->obtenerGrosorID();
    }
    /**Función para obtener la lista del colores desde el controlador de colores */

    public function obtenerListaGrosores()
    {
        return $this->grosor->obtenerGrosorparaInsumos();
    }


    /**Función para obtener el id de la marca desde el controlador de marca */
    public function obtenerMarcas()
    {
        return $this->marca->obtenerMarcaID();
    }

    /**Función para obtener la lista de la marca desde el controlador de marca */
    public function obtenerListaMarcas()
    {
        return $this->marca->obtenerMarcaparaInsumos();
    }


    /**Función para obtener el id del meterial desde el controlador de material */
    public function obtenerMateriales()
    {
        return $this->material->obtenerMaterialID();
    }

    /**Función para obtener las lista del meterial desde el controlador de material */
    public function obtenerListaMateriales()
    {
        return $this->material->obtenerMaterialparaInsumos();
    }

    /**Función para obtener el nid del medida desde el controlador de medida */
    public function obtenerMedidas()
    {
        return $this->medida->obtenerMedidaID();
    }

    /**Función para obtener la lsita del medida desde el controlador de medida */
    public function obtenerListaMedidas()
    {
        return $this->medida->obtenerMedidaparaInsumos();
    }


    /**Función para obtener el id de la presentacion desde el controlador de presentacion */
    public function obtenerPresentaciones()
    {
        return $this->presentacion->obtenerPresentacionID();
    }

    /**Función para obtener la lista de la presentacion desde el controlador de presentacion */
    public function obtenerListaPresentaciones()
    {
        return $this->presentacion->obtenerPresentacionparaInsumos();
    }

    /**Función para obtener el id de proveedor desde el controlador de proveedor */
    public function obtenerProveedores()
    {
        return $this->proveedor->obtenerProveedorID();
    }

    /**Función para obtener las lista de proveedor desde el controlador de proveedor */
    public function obtenerListaProveedores()
    {
        return $this->proveedor->obtenerProveedorparaInsumos();
    }

    /**Función para obtener el id de sbmaterial desde el controlador de submaterial */
    public function obtenerSubMateriales()
    {
        return $this->tipomaterial->obtenerSubMaterialID();
    }

    /**Función para obtener la lsita de sbmaterial desde el controlador de submaterial */
    public function obtenerListaSubMateriales()
    {
        return $this->tipomaterial->obtenerSubMaterialparaInsumos();
    }

    /**Función para obtener el id de tipomedida desde el controlador de tipomedida */
    public function obtenerTiposMedidas()
    {
        return $this->tipomedida->obtenerTipoMedidaID();
    }

    /**Función para obtener la lista de tipomedida desde el controlador de tipomedida */
    public function obtenerListaTiposMedidas()
    {
        return $this->tipomedida->obtenerTipoMedidaparaInsumos();
    }

    /**Función para obtener el id de transparecnia desde el controlador de transparencia*/

    public function obtenerTransparencias()
    {
        return $this->transparencia->obtenerTransparenciaID();
    }

    /**Función para obtener las lista de transparecnia desde el controlador de transparencia*/
    public function obtenerListaTransparencias()
    {
        return $this->transparencia->obtenerTransparenciaparaInsumos();
    }


    /**Función para obtener el id de ubicacion desde el controlador de ubicacion*/
    public function obtenerUbicaciones()
    {
        return $this->ubicacion->obtenerUbicacionID();
    }

    /**Función para obtener la lista de ubicacion desde el controlador de ubicacion*/
    public function obtenerListaUbicaciones()
    {
        return $this->ubicacion->obtenerUbicacionparaInsumos();
    }

    public function validarInsumo(
        $nomInsumo,
        $fechacompra,
        $fechauso,
        $cantidad,
        $rendimiento,
        $precio,
        $disponibilidad,
        $idubicacion,
        $idcolor,
        $idtransparencia,
        $idacabado,
        $idpresentacion,
        $idtipomedida,
        $idmedida,
        $idgrosor,
        $idmaterial,
        $idproveedor,
        $idmarca,
        $idsubmaterial
    ) {

        return $this->insumo->validarInsumo(
            $nomInsumo,
            $fechacompra,
            $fechauso,
            $cantidad,
            $rendimiento,
            $precio,
            $disponibilidad,
            $idubicacion,
            $idcolor,
            $idtransparencia,
            $idacabado,
            $idpresentacion,
            $idtipomedida,
            $idmedida,
            $idgrosor,
            $idmaterial,
            $idproveedor,
            $idmarca,
            $idsubmaterial
        );
    }
    /**Función para procesar los datos de la busqueda */
    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor = $_POST['valor'];
            $resultados = $this->buscarInsumos($busqueda, $valor);
            include '../Vista/buscarInsumo.php';
        }
    }

    /**Función para validar que el empleado se no se encuentre registrado 
    public function validarEmpleado($ide){
        return $this->emplado->obtenerIDEmpleado($ide);
    }*/

    /**Funcion para procesar los datos recibidos del formulario */
    public function procesarDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nomInsumo = $_POST['nomInsumo'];
            $fechacompra = $_POST['fechacompra'];
            $fechauso = $_POST['fechauso'];
            $cantidad = $_POST['cantidad'];
            $rendimiento = $_POST['rendimiento'];
            $precio = $_POST['precio'];
            $disponibilidad = $_POST['disponibilidad'];
            $idubicacion = $_POST['idubicacion'];
            $idcolor = $_POST['idcolor'];
            $idtransparencia = $_POST['idtransparencia'];
            $idacabado = $_POST['idacabado'];
            $idpresentacion = $_POST['idpresentacion'];
            $idtipomedida = $_POST['idtipomedida'];
            $idmedida = $_POST['idmedida'];
            $idgrosor = $_POST['idgrosor'];
            $idmaterial = $_POST['idmaterial'];
            $idproveedor = $_POST['idproveedor'];
            $idmarca = $_POST['idmarca'];
            $idsubmaterial = $_POST['idsubmaterial'];




            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->insumo->validarInsumo(
                    $nomInsumo,
                    $fechacompra,
                    $fechauso,
                    $cantidad,
                    $rendimiento,
                    $precio,
                    $disponibilidad,
                    $idubicacion,
                    $idcolor,
                    $idtransparencia,
                    $idacabado,
                    $idpresentacion,
                    $idtipomedida,
                    $idmedida,
                    $idgrosor,
                    $idmaterial,
                    $idproveedor,
                    $idmarca,
                    $idsubmaterial
                )) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Controlador/controladorInsumo.php?accion=actualizar&id=$id&error=Insumo+existente");
                    exit;
                }
                $this->actualizarInsumo(
                    $id,
                    $nomInsumo,
                    $fechacompra,
                    $fechauso,
                    $cantidad,
                    $rendimiento,
                    $precio,
                    $disponibilidad,
                    $idubicacion,
                    $idcolor,
                    $idtransparencia,
                    $idacabado,
                    $idpresentacion,
                    $idtipomedida,
                    $idmedida,
                    $idgrosor,
                    $idmaterial,
                    $idproveedor,
                    $idmarca,
                    $idsubmaterial
                );
            } else {
                if ($this->insumo->validarInsumo(
                    $nomInsumo,
                    $fechacompra,
                    $fechauso,
                    $cantidad,
                    $rendimiento,
                    $precio,
                    $disponibilidad,
                    $idubicacion,
                    $idcolor,
                    $idtransparencia,
                    $idacabado,
                    $idpresentacion,
                    $idtipomedida,
                    $idmedida,
                    $idgrosor,
                    $idmaterial,
                    $idproveedor,
                    $idmarca,
                    $idsubmaterial
                )) {
                    // Redirigir con el mensaje de error en la URL
                    header("Location: ../Vista/registroInsumo.php?error=Insumo+ya+existente");
                    exit;
                }
                /**Se llama a la funcion de crear el insumo */
                $this->crearInsumo(
                    $nomInsumo,
                    $fechacompra,
                    $fechauso,
                    $cantidad,
                    $rendimiento,
                    $precio,
                    $disponibilidad,
                    $idubicacion,
                    $idcolor,
                    $idtransparencia,
                    $idacabado,
                    $idpresentacion,
                    $idtipomedida,
                    $idmedida,
                    $idgrosor,
                    $idmaterial,
                    $idproveedor,
                    $idmarca,
                    $idsubmaterial
                );
            }

            /**Redirigir al listado de insumos*/
            header("Location: ../Vista/buscarInsumo.php");
            exit;
        }
    }
}


/**Control de opciones de las funciones integradas en las vistas */
if (isset($_GET['accion'])) {
    $controlador = new controladorInsumo();

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
                $insumo = $controlador->obtenerInsumosID($_GET['id']);
                $ubicacion = $controlador->obtenerUbicaciones();
                $color = $controlador->obtenerColores();
                $transparencia = $controlador->obtenerTransparencias();
                $acabado = $controlador->obtenerAcabados();
                $presentacion = $controlador->obtenerPresentaciones();
                $tipomedida = $controlador->obtenerTiposMedidas();
                $medida = $controlador->obtenerMedidas();
                $grosor = $controlador->obtenerGrosores();
                $material = $controlador->obtenerMateriales();
                $proveedor = $controlador->obtenerProveedores();
                $marca = $controlador->obtenerMarcas();
                $tipomaterial = $controlador->obtenerSubMateriales();
                include '../Vista/editarInsumo.php';
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                $controlador->eliminarInsumo($_GET['id']);
            }
            header("Location: ../Vista/buscarInsumo.php");
            break;
        default:
            header("Location: ../Vista/registroInsumo.php");
            break;
    }
}
