<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Grosor{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los grosor */
        public function obtenerGrosores(){
            $query = "select * from grosor";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos grosor */
        public function agregaGrosor($cantGrosor, $unidadMedida, $flexibilidad){
            $query = "insert into grosor (cantGrosor,unidadMedida, flexibilidad) values ('$cantGrosor','$unidadMedida','$flexibilidad');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar grosor dependiendo el criterio del usuario */
        public function buscarGrosorPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['cantGrosor','flexibilidad'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerGrosores(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from grosor where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un grosor */
        public function actualizarGrosor($id, $cantGrosor,$unidadMedida,$flexibilidad){
            $query = "update grosor set cantGrosor= '$cantGrosor', unidadMedida ='$unidadMedida',flexibilidad ='$flexibilidad'
            where idgrosor = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarGrosor($id){
            $query = "delete from grosor where idgrosor =$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerGrosorID(){
            $query = "select idgrosor, concat(cantGrosor, ' ', unidadMedida) as grosor from grosor;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
     
       
        public function obtenerGrosor($grosor){
            $sql = "select cantGrosor from grosor where cantGrosor in('$grosor'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }

        public function obtenerGrosorparaInsumos() {
            $sql = "select idgrosor, concat(cantGrosor, ' ', unidadMedida) as grosor from grosor";
            $result = mysqli_query($this->conn, $sql);
            $grosores = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $grosores[] = $row;
            }
            return $grosores;
        }

        public function validarGrosor($cantGrosor, $unidadMedida, $flexibilidad) {
            // Escapar los valores para evitar inyección SQL
            $cantGrosor = mysqli_real_escape_string($this->conn, $cantGrosor);
            $unidadMedida = mysqli_real_escape_string($this->conn, $unidadMedida);
            $flexibilidad = mysqli_real_escape_string($this->conn, $flexibilidad);

        
            // Consulta para verificar la existencia
            $query = "SELECT COUNT(*) as total 
                      FROM grosor
                      WHERE CONCAT(cantGrosor, '|', unidadMedida, '|', flexibilidad) = CONCAT('$cantGrosor', '|', '$unidadMedida', '|', '$flexibilidad')";
            
            $resultado = mysqli_query($this->conn, $query);
        
            // Verificar si existe al menos un registro con la misma combinación
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total'] > 0;
        }

    }
