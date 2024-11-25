<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Color{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los color */
        public function obtenerColores(){
            $query = "select * from color";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos color */
        public function agregaColor($nombre){
            $query = "insert into color (nomColor) values ('$nombre');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar color dependiendo el criterio del usuario */
        public function buscarColorPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['nomColor'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerColores(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from color where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un color */
        public function actualizarColor($id, $nombre){
            $query = "update color set nomColor= '$nombre'  
            where idcolor = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarColor($id){
            $query = "delete from color where idcolor=$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerColorID(){
            $query = "select idcolor, nomColor as color from color;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
     
    
        public function obtenerColor($color){
            $sql = "select nomColor from color where nomColor in('$color'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }

        public function obtenerColorparaInsumos() {
            $sql = "select idcolor, nomColor as color from color";
            $result = mysqli_query($this->conn, $sql);
            $colores = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $colores[] = $row;
            }
            return $colores;
        }

    }

