

<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de pedidos, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Pedido{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn; 
        }

        public function obtenerPedidos(){
            $query = "select * from pedido;";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos pedidos */
        public function agregarPedido($cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado){
            $query = "insert into pedido (cant, nombrecliente, fechaPedido, idproductoFinal, idempleado, idestado) 
            values ('$cant', '$nombrecliente', '$fechaPedido', $idproductoFinal, $idempleado, $idestado);";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                echo "Registro exitoso.";
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($this->conn);
            }
            return $result;
           
        }

        /**Funcion para buscar pedidos dependiendo el criterio del usuario */
        public function buscarPedidoPorCriterio($busqueda, $valor){
            $valor = mysqli_real_escape_string($this->conn, $valor);

            if($busqueda == 'idproductoFinal'){
                $query = "select pedido.serie, pedido.cant, pedido.nombrecliente, pedido.fechaPedido, productoFinal.nombre as productof,
                concat(empleado.nomb, ' ', empleado.apaterno) as empleado, estado.estado as estado from
                pedido inner join productoFinal on productoFinal.idproductoFinal = pedido.idproductoFinal
                inner join empleado on empleado.idempleado = pedido.idempleado inner join estado on 
                estado.idestado = pedido.idestado where productofinal.nombre like '%$valor%';";

            }else if($busqueda == 'idempleado'){
                $query = "select pedido.serie, pedido.cant, pedido.nombrecliente, pedido.fechaPedido, productoFinal.nombre as productof,
                concat(empleado.nomb, ' ', empleado.apaterno) as empleado, estado.estado as estado from
                pedido inner join productoFinal on productoFinal.idproductoFinal = pedido.idproductoFinal
                inner join empleado on empleado.idempleado = pedido.idempleado inner join estado on 
                estado.idestado = pedido.idestado where concat(empleado.nomb, ' ', empleado.apaterno) like '%$valor%';";

            }else if($busqueda == 'idestado'){
                $query = "select pedido.serie, pedido.cant, pedido.nombrecliente, pedido.fechaPedido, productofinal.nombre as productof,
                concat(empleado.nomb, ' ', empleado.apaterno) as empleado, estado.estado as estado from
                pedido inner join productoFinal on productoFinal.idproductoFinal = pedido.idproductoFinal
                inner join empleado on empleado.idempleado = pedido.idempleado inner join estado on 
                estado.idestado = pedido.idestado where estado.estado like '%$valor%';";

            }else{
                $query = "select pedido.serie, pedido.cant, pedido.nombrecliente, pedido.fechaPedido, productoFinal.nombre as productof,
                concat(empleado.nomb, ' ', empleado.apaterno) as empleado, estado.estado as estado from
                pedido inner join productoFinal on productoFinal.idproductoFinal = pedido.idproductoFinal
                inner join empleado on empleado.idempleado = pedido.idempleado inner join estado on 
                estado.idestado = pedido.idestado where $busqueda like '%$valor%';";
            }

            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        }        

        public function actualizarPedido($id, $cant, $nombrecliente, $fechaPedido, $idproductoFinal, $idempleado, $idestado){
            $query = "update pedido set cant = $cant, nombrecliente = '$nombrecliente', fechaPedido = '$fechaPedido',
            idproductoFinal = $idproductoFinal, idempleado = $idempleado, idestado = $idestado where serie = $id; ";
            $result = mysqli_query($this->conn, $query);

            if ($result) {
                echo "Actualización exitosa.";
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($this->conn);
            }
            return $result;  
        }

        public function eliminarPedido($id){
            $query = "delete from pedido where serie=$id;";
            return mysqli_query($this->conn, $query);
        }

        
        public function obtenerPedidoID(){
           $query = "select serie, concat(pedido.nombrecliente, ', ', productofinal.nombre) as datos from pedido inner join 
            productofinal on productofinal.idproductoFinal = pedido.idproductoFinal;";
           $exe = mysqli_query($this->conn, $query);
           return mysqli_fetch_all($exe, MYSQLI_ASSOC); 
        }  
        
        public function obtenerPedidoparaDetalle() {
            $sql = "select serie, concat(pedido.nombrecliente, ', ', productofinal.nombre) as datos from pedido inner join 
            productofinal on productofinal.idproductoFinal = pedido.idproductoFinal;";
            $result = mysqli_query($this->conn, $sql);
            $pedidos = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $pedidos[] = $row;
            }
            return $pedidos;
        }

    

        public function contabilizarPedidosFecha($busqueda, $valor1, $valor2){
            $valor1 = mysqli_real_escape_string($this->conn, $valor1);
            $valor2 = mysqli_real_escape_string($this->conn, $valor2);

            if($busqueda == 'fechaPedido'){
                $sql = "select empleado.nomb as nombre, empleado.apaterno as apaterno, empleado.amaterno as amaterno, empleado.fecnaci as naci, 
                empleado.direccion as direccion, empleado.correo as correo, count(pedido.idempleado) as pedidos from pedido 
                inner join empleado on empleado.idempleado = pedido.idempleado where pedido.fechaPedido between '$valor1' and '$valor2' 
                group by pedido.idempleado;";
            }
            $resultado = mysqli_query($this->conn, $sql);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        public function contabilizarInsumosFecha($busqueda, $valor1, $valor2){
            $valor1 = mysqli_real_escape_string($this->conn, $valor1);
            $valor2 = mysqli_real_escape_string($this->conn, $valor2);

            if($busqueda == 'fechaPedido'){
                $sql = "select productoFinal.nombre as productof, COUNT(DISTINCT insumoproducto.idinsumos) as cantidad from pedido 
                inner join productoFinal on pedido.idproductoFinal = productoFinal.idproductoFinal inner join insumoproducto on 
                insumoproducto.idproductoFinal = productoFinal.idproductoFinal where pedido.fechaPedido between
                '$valor1' and '$valor2' group by pedido.idproductoFinal desc;";
            }
            $resultado = mysqli_query($this->conn, $sql);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }
   
}

?>