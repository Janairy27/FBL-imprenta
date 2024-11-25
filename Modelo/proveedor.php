<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de empleado, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class Proveedor{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn;
        }

        /**función para obtener todos los proveedor */
        public function obtenerProveedores(){
            $query = "select * from proveedor";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos proveedor  */
        public function agregarProveedor($nombre, $direccion,$contacto, $telefono, $correo , $numCliente){
            $query = "insert into proveedor (Nomproveedor, direccion,contacto, telefono, correo, NoCliente) values ('$nombre',  '$direccion','$contacto', $telefono, '$correo','$numCliente');";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar proveedor  dependiendo el criterio del usuario */
        public function buscarProveedorPorCriterio($busqueda, $valor){
            /**Arreglo que contiene las posibles opciones de busqueda */
            $busquedaPermitida = ['Nomproveedor', 'direccion', 'telefono', 'correo'];
            if(!in_array($busqueda, $busquedaPermitida)){
                return $this->obtenerProveedores(); /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
            }

            $valor = mysqli_real_escape_string($this->conn, $valor);
            $query = "select * from proveedor where $busqueda like '%$valor%';";
            $execute = mysqli_query($this->conn, $query);

            return mysqli_fetch_all($execute, MYSQLI_ASSOC);

        }        

        /**función para actualizar un proveedor  */
        public function actualizarProveedor($id, $nombre, $direccion,$contacto, $telefono, $correo,$numCliente){
            $query = "update proveedor set Nomproveedor= '$nombre', direccion = '$direccion',contacto ='$contacto', telefono = '$telefono', telefono = $telefono, correo = '$correo'  , NoCliente = '$numCliente'       
            where idproveedor = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarProveedor($id){
            $query = "delete from proveedor where idproveedor=$id;";
            return mysqli_query($this->conn, $query);
        }
        public function obtenerProveedorID(){
            $query = "select idproveedor, Nomproveedor as proveedor from proveedor;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
        
     
               public function validarTelefono($tel){
            $sql = "select telefono from proveedor where telefono in('$tel'); ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }

        public function validarCorreo($corr){
            $sql = "select correo from proveedor where correo = '$corr'; ";
            $exec = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($exec);
        }


        public function validarProveedor($nombre, $direccion,$contacto, $telefono, $correo,$numCliente) {
            // Escapar los valores para evitar inyección SQL

            $nombre = mysqli_real_escape_string($this->conn, $nombre);
            $direccion = mysqli_real_escape_string($this->conn, $direccion);
            $contacto = mysqli_real_escape_string($this->conn, $contacto);
            $telefono = mysqli_real_escape_string($this->conn, $telefono);
            $correo = mysqli_real_escape_string($this->conn, $correo);
            $numCliente = intval( $numCliente);
            // Consulta para verificar la existencia
            $query = "SELECT COUNT(*) as total 
                      FROM proveedor
                      WHERE CONCAT(Nomproveedor,'|', direccion,'|', contacto,  '|', telefono, '|',
        correo,'|', NoCliente) 
                      = CONCAT('$nombre', '|', '$direccion', '|', '$contacto', '|', '$telefono','|', 
                      '$correo','|','$numCliente');";
            
            $resultado = mysqli_query($this->conn, $query);
        
            // Verificar si existe al menos un registro con la misma combinación
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total'] > 0;
        }

        public function obtenerProveedorparaInsumos() {
            $sql = "select idproveedor, Nomproveedor as proveedor from proveedor";
            $result = mysqli_query($this->conn, $sql);
            $proveedores = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $proveedores[] = $row;
            }
            return $proveedores;
        }

    }


