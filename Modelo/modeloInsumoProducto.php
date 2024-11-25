
<?php
/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

class ProductoIn
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los productos para el insumo */
    public function obtenerProductosIn()
    {
        $query = "select * from insumoproducto;";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function agregarProductoIn($idproductoFinal, $idinsumo, $cantidad, $medida)
    {
        $query = "insert into insumoproducto (idproductoFinal, idinsumos, cantidadInsumo, medidaProducto) 
            values ('$idproductoFinal', '$idinsumo', '$cantidad', '$medida');";
        return mysqli_query($this->conn, $query);
    }

    /**Función para realizar la busqueda pora diferentes atributos de la tabla, dependiendo lo que seleccione el usuario
     * es el parametro de la tabla en la que estará realizando la búsqueda 
     */
    public function buscarProductoInPorCriterio($busqueda, $valor)
    {
        $valor = mysqli_real_escape_string($this->conn, $valor);
        if ($busqueda == 'idproductoFinal') {
            $query = "select insumoproducto.idinsumoProducto, productoFinal.nombre as prodf, insumos.nomInsumo as insumo, insumoproducto.cantidadInsumo as cant, insumoproducto.medidaProducto as medida
                from insumoproducto inner join productoFinal on productoFinal.idproductoFinal = insumoproducto.idproductoFinal
                inner join insumos on insumos.idinsumos = insumoproducto.idinsumos where productofinal.nombre like '%$valor%';";
        } elseif ($busqueda == 'idinsumos') {
            $query = "select insumoproducto.idinsumoProducto, productoFinal.nombre as prodf, insumos.nomInsumo as insumo, insumoproducto.cantidadInsumo as cant, insumoproducto.medidaProducto as medida
                from insumoproducto inner join productoFinal on productoFinal.idproductoFinal = insumoproducto.idproductoFinal
                inner join insumos on insumos.idinsumos = insumoproducto.idinsumos where insumos.nombre like '%$valor%';";
        } else {
            $query = "select insumoproducto.idinsumoProducto, productoFinal.nombre as prodf, insumos.nomInsumo as insumo, insumoproducto.cantidadInsumo as cant, insumoproducto.medidaProducto as medida
                from insumoproducto inner join productoFinal on productoFinal.idproductoFinal = insumoproducto.idproductoFinal
                inner join insumos on insumos.idinsumos = insumoproducto.idinsumos where $busqueda like '%$valor%';";
        }

        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function actualizarProdInsumo($id, $idproductoFinal, $idinsumo, $cantidad, $medida)
    {
        $query = "update insumoproducto set idproductoFinal = $idproductoFinal, idinsumos = $idinsumo, cantidadInsumo = $cantidad, 
            medidaProducto = '$medida' where idinsumoProducto = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarProdInsumo($id)
    {
        $query = "delete from insumoproducto where idinsumoProducto=$id;";
        return mysqli_query($this->conn, $query);
    }

    public function obtenerProdInsumoID($id)
    {
        $query = "select * from insumoproducto where idinsumoProducto = $id;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($exe);
    }

    /**Función correspondiente para realizar la selección de información que se estará mostrando en alguna lista 
     * desplegable con el fin de mostrar más información al usuario y este mismo tenga conocimiento 
     * de lo que se esta relacionando
     */
    public function obtenerInsumosProdparaProducto()
    {
        $sql = "select idinsumoProducto, concat(productofinal.nombre, ' ', insumos.nombre) as nombre from insumoproducto inner
            join productofinal on productofinal.idproductoFinal = insumoproducto.idproductoFinal inner join insumos on
            insumos.idinsumos = productofinal.idinsumos";
        $result = mysqli_query($this->conn, $sql);
        $insumosprod = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $insumosprod[] = $row;
        }
        return $insumosprod;
    }
}


?>
