<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Ubicacion{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los ubicacion */
        public function obtenerUbicaciones(){
            $query = "select * from ubicacion";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos ubicacion */
        public function agregarUbicacion($mueble, $division1, $division2, $division3) {
            $mueble = mysqli_real_escape_string($this->conn, $mueble);
            $division1 = mysqli_real_escape_string($this->conn, $division1);
            $division2 = mysqli_real_escape_string($this->conn, $division2);
            $division3 = mysqli_real_escape_string($this->conn, $division3);
    
            $query = "INSERT INTO ubicacion (mueble, division1, division2, division3) 
                      VALUES ('$mueble', '$division1', '$division2', '$division3')";
    
            return mysqli_query($this->conn, $query);
        }
    
        

        /**Funcion para buscar ubicacion dependiendo el criterio del usuario */
        public function buscarUbicacionPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['mueble', 'division1', 'division2', 'division3'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerUbicaciones(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from ubicacion where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un ubicacion */
        public function actualizarUbicacion($id, $mueble, $division1, $division2, $division3) {
            $id = (int)$id;
            $mueble = mysqli_real_escape_string($this->conn, $mueble);
            $division1 = mysqli_real_escape_string($this->conn, $division1);
            $division2 = mysqli_real_escape_string($this->conn, $division2);
            $division3 = mysqli_real_escape_string($this->conn, $division3);
    
            $query = "UPDATE ubicacion 
                      SET mueble = '$mueble', division1 = '$division1', division2 = '$division2', division3 = '$division3' 
                      WHERE idubicacion = $id";
    
            return mysqli_query($this->conn, $query);
        }
        public function eliminarUbicacion($id){
            $query = "delete from ubicacion where idubicacion=$id;";
            return mysqli_query($this->conn, $query);
        }

        public function obtenerUbicacionID(){
            $query = "select idubicacion, concat(mueble, ' ', division1, ' ', division2, ' ', division3) as ubicacion from ubicacion;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }

        public function validarUbicacion($mueble, $division1, $division2, $division3) {
            // Escapar los valores para evitar inyección SQL
            $mueble = mysqli_real_escape_string($this->conn, $mueble);
            $division1 = mysqli_real_escape_string($this->conn, $division1);
            $division2 = mysqli_real_escape_string($this->conn, $division2);
            $division3 = mysqli_real_escape_string($this->conn, $division3);
        
            // Consulta para verificar la existencia
            $query = "SELECT COUNT(*) as total 
                      FROM ubicacion 
                      WHERE CONCAT(mueble, '|', division1, '|', division2, '|', division3) = CONCAT('$mueble', '|', '$division1', '|', '$division2', '|', '$division3')";
            
            $resultado = mysqli_query($this->conn, $query);
        
            // Verificar si existe al menos un registro con la misma combinación
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total'] > 0;
        }
        

        public function obtenerUbicacionparaInsumos() {
            $sql = "select idubicacion, concat(mueble, ' ', division1, ' ', division2, ' ', division3) as ubicacion from ubicacion";
            $result = mysqli_query($this->conn, $sql);
            $ubicaciones = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $ubicaciones[] = $row;
            }
            return $ubicaciones;
        }

    }


