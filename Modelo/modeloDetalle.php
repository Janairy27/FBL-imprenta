<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de detalle, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Detalle
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function obtenerDetalles()
    {
        $query = "select * from detalle";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar detalle */
    public function agregarDetalle($descuento, $subtotal, $iva, $total, $serie)
    {
        $query = "insert into detalle (descuento, subtotal, iva, total, serie) values 
            ($descuento, $subtotal, $iva, $total, $serie);";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar detalle dependiendo el criterio del usuario */
    public function buscarDetallePorCriterio($busqueda, $valor)
    {
        $valor = mysqli_real_escape_string($this->conn, $valor);

        if ($busqueda == 'serie') {
            $query = "select detalle.folio, detalle.descuento, detalle.subtotal, detalle.iva, detalle.total,
                concat(pedido.nombrecliente, ', ', pedido.fechaPedido, ', ', productoFinal.nombre) as pedido from
                detalle inner join pedido on pedido.serie = detalle.serie inner join productoFinal on pedido.idproductoFinal = productoFinal.idproductoFinal
                where concat(pedido.nombrecliente, ', ', pedido.fechaPedido, ', ', productoFinal.nombre) like '%$valor%';";
        } else {
            $query = "select detalle.folio, detalle.descuento, detalle.subtotal, detalle.iva, detalle.total,
                concat(pedido.nombrecliente, ', ', pedido.fechaPedido, ', ', productoFinal.nombre) as pedido from
                detalle inner join pedido on pedido.serie = detalle.serie inner join productoFinal on pedido.idproductoFinal = productoFinal.idproductoFinal
                where $busqueda like  '%$valor%';";
        }

        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para actualizar un detalles */
    public function actualizarDetalle($id, $descuento, $subtotal, $iva, $total, $serie)
    {

        $query = "update detalle set descuento = $descuento, subtotal = $subtotal, 
            total = $total, serie = $serie where folio = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarDetalle($id)
    {
        $query = "delete from detalle where folio=$id;";
        return mysqli_query($this->conn, $query);
    }


    public function obtenerDetalleID($id)
    {
        $query = "select * from detalle where folio = $id;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($exe);
    }
}
