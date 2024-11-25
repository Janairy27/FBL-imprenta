<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class AcabadoSuperficial{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los acabado */
        public function obtenerAcabados(){
            $query = "select * from acabado";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos acabado */
        public function agregaAcabado($nombre){
            $query = "insert into acabado (nomAcabado) values ('$nombre');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar empleados dependiendo el criterio del usuario */
        public function buscarAcabadoPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['nomAcabado'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerAcabados(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from acabado where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un acabado */
        public function actualizarAcabado($id, $nombre){
            $query = "update acabado set nomAcabado= '$nombre'  
            where idacabado = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarAcabado($id){
            $query = "delete from acabado where idacabado=$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerAcabadoID(){
            $query = "select idacabado, nomAcabado as acabado from acabado;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }

        public function validarAcabado($acabado){
            $sql = "select nomAcabado from acabado where nomAcabado in('$acabado'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }
        
     
     
        public function obtenerAcabado($acabado){
            $sql = "select nomAcabado from acabado where nomAcabado in('$acabado'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }

        public function obtenerAcabadoparaInsumos() {
            $sql = "select idacabado, nomAcabado as acabado from acabado";
            $result = mysqli_query($this->conn, $sql);
            $acabados = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $acabados[] = $row;
            }
            return $acabados;
        }

    }
