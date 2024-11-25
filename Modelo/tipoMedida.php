<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class TipoMedida{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los tipomedida */
        public function obtenerTiposMedidas(){
            $query = "select * from tipomedida";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos tipomedida */
        public function agregaTipoMedida($nombre, $unidad){
            $query = "insert into tipomedida (nomTipomedida, unidad) values ('$nombre','$unidad');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar tipomedida dependiendo el criterio del usuario */
        public function buscarTipoMedidaPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['nomTipomedida','unidad'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerTiposMedidas(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from tipomedida where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un tipomedida */
        public function actualizarTipoMedida($id, $nombre,$unidad){
            $query = "update tipomedida set nomTipomedida= '$nombre',unidad ='$unidad'
            where idtipomedida = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarTipoMedida($id){
            $query = "delete from tipomedida where idtipomedida=$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerTipoMedidaID(){
            $query = "select idtipomedida, concat(nomTipomedida, ' ',unidad) as tipomedida from tipomedida;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
        public function validarTipoMedida($tipomedida,$unidad) {
            // Escapar los valores para evitar inyección SQL
            $tipomedida= mysqli_real_escape_string($this->conn, $tipomedida);
            $unidad = mysqli_real_escape_string($this->conn, $unidad);
        
            // Consulta para verificar la existencia
            $query = "SELECT COUNT(*) as total 
                      FROM tipomedida 
                      WHERE concat(nomTipomedida, ' | ', unidad) = concat('$tipomedida', ' | ', '$unidad')";
            
            $resultado = mysqli_query($this->conn, $query);
        
            // Verificar si existe al menos un registro con la misma combinación
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total'] > 0;
        }

        public function obtenerTipoMedidaparaInsumos() {
            $sql = "select idtipomedida, concat(nomTipomedida, ' ', unidad) as tipomedida from tipomedida";
            $result = mysqli_query($this->conn, $sql);
            $tiposmedidas = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $tiposmedidas[] = $row;
            }
            return $tiposmedidas;
        }

    }
