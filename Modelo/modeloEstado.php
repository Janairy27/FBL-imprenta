<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de estado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Estado{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los estados */
        public function obtenerEstados(){
            $query = "select * from estado";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos estados de los pedidos */
        public function agregarEstado($estado){
            $query = "insert into estado (estado) values ('$estado');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar estados dependiendo el criterio del usuario */
        public function buscarEstadoPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['estado'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerEstados(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from estado where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un empleado */
        public function actualizarEstado($id, $estado){
            $query = "update estado set estado = '$estado' where idestado = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarEstado($id){
            $query = "delete from estado where idestado=$id;";
            return mysqli_query($this->conn, $query);
        }

        public function obtenerEstadoID(){
            $query = "select idestado,estado from estado;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
        /**funcion para obtener todos los estados y poder mostrarlos en el registro de pedidos */
        public function obtenerEstadosparaPedido() {
            $sql = "select idestado,estado from estado; ";
            $result = mysqli_query($this->conn, $sql);
            $estados = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $estados[] = $row;
            }
            return $estados;
        }

        /**obtencion del estado para validar que no existan estados repetidos */
        public function obtenerEstado($est){
            $sql = "select estado from estado where estado ='$est'; ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }


    }


?>
