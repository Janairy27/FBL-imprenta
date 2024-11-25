<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Tipomaterial{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los submaterial */
        public function obtenerSubMateriales(){
            $query = "select * from submaterial";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos submaterial */
        public function agregaSubMaterial($nombre){
            $query = "insert into submaterial (nomSubmaterial) values ('$nombre');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar submaterial dependiendo el criterio del usuario */
        public function buscarSubMaterialPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['nomsubmaterial'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerSubMateriales(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from submaterial where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un submaterial */
        public function actualizarSubMaterial($id, $nombre){
            $query = "update submaterial set nomSubmaterial= '$nombre'
            where idsubmaterial = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarSubMaterial($id){
            $query = "delete from submaterial where idsubmaterial=$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerSubMaterialID(){
            $query = "select idsubmaterial, nomSubmaterial as submaterial from submaterial;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
     
      
        public function obtenerSubMaterial($submaterial){
            $sql = "select nomSubmaterial from submaterial where nomSubmaterial in('$submaterial'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }
        public function obtenerSubmaterialparaInsumos() {
            $sql = "select idsubmaterial,nomSubmaterial as submaterial from submaterial";
            $result = mysqli_query($this->conn, $sql);
            $submateriales = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $submateriales[] = $row;
            }
            return $submateriales;
        }

    }