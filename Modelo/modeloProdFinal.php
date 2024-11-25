<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de productos finales, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class ProdFinal
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los productos finales */
    public function obtenerProducto()
    {
        $query = "select * from productoFinal ";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos productos finales */
    public function agregarProducto($nombre, $precio)
    {
        $query = "insert into productoFinal (nombre, precio) values ('$nombre', $precio);";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar productos dependiendo el criterio del usuario */
    public function buscarProductoPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nombre', 'precio'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerProducto();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from productoFinal where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un empleado */
    public function actualizarProducto($id, $nombre, $precio)
    {
        $query = "update productoFinal set nombre = '$nombre', precio = $precio where idproductoFinal = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarProducto($id)
    {
        $query = "delete from productoFinal where idproductoFinal=$id;";
        return mysqli_query($this->conn, $query);
    }

    public function obtenerProductoID()
    {
        $query = "select productoFinal.idproductoFinal, productoFinal.nombre as productof from productoFinal;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }

    /**funcion para obtener todos los productos finales y poder mostrarlos en el registro de pedido */
    public function obtenerProductosFinales()
    {
        $sql = "select productoFinal.idproductoFinal, productoFinal.nombre as productof from productoFinal;";
        $result = mysqli_query($this->conn, $sql);
        $productos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
        return $productos;
    }
}
