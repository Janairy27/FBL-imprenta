
<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de usuario, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Baja{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn; 
        }

        public function obtenerBajas(){
            $query = "select * from baja;";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos baja */
        public function agregarBaja($cantidad, $fechabaja, $motivo, $idinsumos, $idempleado) {
            // Verificar que hay suficiente cantidad disponible
            $queryCheckCantidad = "SELECT cantidad FROM insumos WHERE idinsumos = ?";
            $stmtCheck = $this->conn->prepare($queryCheckCantidad);
            $stmtCheck->bind_param("i", $idinsumos);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result()->fetch_assoc();
    
            if (!$resultCheck || $resultCheck['cantidad'] < $cantidad) {
                return "Cantidad insuficiente en inventario.";
            }
    
            // Insertar la baja en la tabla `baja`
            $queryBaja = "INSERT INTO baja (cantBaja, fechaBaja, motivo, idinsumos, idempleado) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmtBaja = $this->conn->prepare($queryBaja);
            $stmtBaja->bind_param("issii", $cantidad, $fechabaja, $motivo, $idinsumos, $idempleado);
    
            if (!$stmtBaja->execute()) {
                return "Error al registrar la baja.";
            }
    
            // Actualizar la cantidad en la tabla `insumos`
            $queryUpdateCantidad = "UPDATE insumos SET cantidad = cantidad - ? WHERE idinsumos = ?";
            $stmtUpdate = $this->conn->prepare($queryUpdateCantidad);
            $stmtUpdate->bind_param("ii", $cantidad, $idinsumos);
    
            if (!$stmtUpdate->execute()) {
                return "Error al actualizar la cantidad en inventario.";
            }
    
            return true;
        }

        /**Funcion para buscar baja dependiendo el criterio del usuario */
       public function buscarBajaPorCriterio($busqueda, $valor){
            $valor = mysqli_real_escape_string($this->conn, $valor);
            if($busqueda == 'idinsumos'){
                $query = "SELECT baja.idbaja, baja.cantBaja,  baja.fechaBaja, baja.motivo,
                CONCAT(insumos.nomInsumo, ' ', insumos.fechacompra, ' ', insumos.disponibilidad) AS insumos,
                concat(empleado.nomb, ' ', empleado.apaterno) AS nombre
                FROM baja
                INNER JOIN insumos ON insumos.idinsumos = baja.idinsumos
                INNER JOIN empleado ON empleado.idempleado = baja.idempleado
                WHERE 
                CONCAT(insumos.nomInsumo, ' ', insumos.fechcompra, ' ', insumos.disponibilidad) LIKE '%$valor%';";
            } else  if($busqueda == 'idempleado'){
                $query = "SELECT baja.idbaja,baja.cantBaja,  baja.fechaBaja, baja.motivo,
                CONCAT(insumos.nomInsumo, ' ', insumos.fechacompra, ' ', insumos.disponibilidad) AS insumos,
                concat(empleado.nomb, ' ', empleado.apaterno) AS nombre
                FROM baja
                INNER JOIN insumos ON insumos.idinsumos = baja.idinsumos
                INNER JOIN empleado ON empleado.idempleado = baja.idempleado
                WHERE 
                concat(empleado.nomb, ' ', empleado.apaterno) LIKE '%$valor%';";
                
            } 
            else{
                $query = "SELECT baja.idbaja,baja.cantBaja,  baja.fechaBaja, baja.motivo,
                CONCAT(insumos.nomInsumo, ' ', insumos.fechacompra, ' ', insumos.disponibilidad) AS insumos,
                concat(empleado.nomb, ' ', empleado.apaterno) AS nombre
                FROM baja
                INNER JOIN insumos ON insumos.idinsumos = baja.idinsumos
                INNER JOIN empleado ON empleado.idempleado = baja.idempleado
                WHERE $busqueda like '%$valor%';";
            }
            
            $resultado = mysqli_query($this->conn, $query);                   
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        }        
       
        
        /**función para actualizar un baja*/
        public function actualizarBaja($id,$cantidad,$fechabaja,$motivo, $idinsumos, $idempleado){
            $id = intval($id);
            $cantidad = intval($this->conn, $cantidad);
            $fechabaja= mysqli_real_escape_string($this->conn, $fechabaja);
            $motivo= mysqli_real_escape_string($this->conn, $motivo);
            $idinsumos = intval($idinsumos);
            $idempleado = intval($idempleado);

            $query = "update baja set cantBaja= '$cantidad', fechaBaja = '$fechabaja', 
            motivo = '$motivo',  idinsumos = '$idinsumos', idempleado = '$idempleado' where idbaja = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarBaja($id){
            $query = "delete from baja where idbaja=$id;";
            return mysqli_query($this->conn, $query);
        }

        
        public function obtenerBajaID($id){
           $query = "select * from baja where idbaja = $id;";
           $exe = mysqli_query($this->conn, $query);
           return mysqli_fetch_assoc($exe); 
        }  

        public function reporteBajaFecha($busqueda, $valor1, $valor2){
            $valor1 = mysqli_real_escape_string($this->conn, $valor1);
            $valor2 = mysqli_real_escape_string($this->conn, $valor2);

            if($busqueda == 'fechaBaja'){
                $sql = "select   baja.motivo as motivo, baja.fechaBaja as fechaBaja,
                 insumos.nomInsumo as insumo, insumos.fechacompra as fecha,
                 empleado.nomb as nombre, empleado.apaterno as apaterno, 
                 empleado.correo as correo
                 from baja
                 inner join insumos on insumos.idinsumos = baja.idinsumos
                inner join empleado on empleado.idempleado = baja.idempleado
                 where baja.fechaBaja between '$valor1' and '$valor2';";
            }
            $resultado = mysqli_query($this->conn, $sql);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        

    }


?>