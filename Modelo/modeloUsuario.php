
<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de usuario, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Usuario{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn; 
        }

        public function obtenerUsuarios(){
            $query = "select * from usuarios;";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos usuarios */
        public function agregarUsuario($usuario, $contrasena, $idempleado){
            $query = "insert into usuarios (usuario, contrasena, idempleado) values ('$usuario', '$contrasena', $idempleado);";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar usuarios dependiendo el criterio del usuario */
        public function buscarUsuarioPorCriterio($busqueda, $valor){
            $valor = mysqli_real_escape_string($this->conn, $valor);

            if($busqueda == 'idempleado'){
                /**Realizar la busqueda del nombre y apellido concatenados */
                $query = "select usuarios.idusuarios, usuarios.usuario, usuarios.contrasena, concat(empleado.nomb, ' ', empleado.apaterno)
                as empleado from usuarios inner join empleado on empleado.idempleado = usuarios.idempleado
                where concat(empleado.nomb, ' ', empleado.apaterno) like '%$valor%';";
            }else{
                /**Realizar la busqueda por criterios como usuario o contraseña */
                $query = "select usuarios.idusuarios, usuarios.usuario, usuarios.contrasena, concat(empleado.nomb, ' ', empleado.apaterno)
                as empleado from usuarios inner join empleado on empleado.idempleado = usuarios.idempleado
                where $busqueda like '%$valor%';";
            }
            
            $resultado = mysqli_query($this->conn, $query);                   
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        }        

        /**función para actualizar un usuario */
        public function actualizarUsuario($id, $usuario, $contrasena, $idempleado){
            $id = intval($id);
            $usuario = mysqli_real_escape_string($this->conn, $usuario);
            $contrasena = mysqli_real_escape_string($this->conn, $contrasena);
            $idempleado = intval($idempleado); // Asegurarse de que sea un entero

            $query = "update usuarios set usuario = '$usuario', contrasena = '$contrasena', idempleado = '$idempleado'            
            where idusuarios = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarUsuario($id){
            $query = "delete from usuarios where idusuarios=$id;";
            return mysqli_query($this->conn, $query);
        }

        
        public function obtenerUsuarioID($id){
           $query = "select * from usuarios where idusuarios = $id;";
           $exe = mysqli_query($this->conn, $query);
           return mysqli_fetch_assoc($exe); 
        }  
        

    }


?>