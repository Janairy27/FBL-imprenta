<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Empleado
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los empleados */
    public function obtenerEmpleados()
    {
        $query = "select * from empleado";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos empleados */
    public function agregarEmpleado($nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol)
    {
        $query = "insert into empleado (nomb, apaterno, amaterno, fecnaci, direccion, telefono,
            correo, rol) values ('$nombre', '$apaterno', '$amaterno', '$fecha', '$direccion', $telefono, '$correo', '$rol');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar empleados dependiendo el criterio del usuario */
    public function buscarEmpleadoPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nomb', 'apaterno', 'direccion', 'telefono', 'correo'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerEmpleados();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from empleado where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un empleado */
    public function actualizarEmpleado($id, $nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol)
    {
        $query = "update empleado set nomb = '$nombre', apaterno = '$apaterno', amaterno = '$amaterno', fecnaci = '$fecha', 
            direccion = '$direccion', telefono = $telefono, correo = '$correo', rol = '$rol'            
            where idempleado = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarEmpleado($id)
    {
        $query = "delete from empleado where idempleado=$id;";
        return mysqli_query($this->conn, $query);
    }
    /**modificacion */
    public function obtenerEmpleadoID()
    {
        $query = "select idempleado, concat(nomb, ' ', apaterno) as nombre from empleado;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }

    /**funcion para obtener todos los empleados y poder mostrarlos en el registro de usuarios */
    public function obtenerEmpleadosparaUsuarios()
    {
        $sql = "select idempleado, concat(nomb, ' ', apaterno) as nombre from empleado";
        $result = mysqli_query($this->conn, $sql);
        $empleados = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $empleados[] = $row;
        }
        return $empleados;
    }

    public function obtenerEmpleadosparaBajas()
    {
        $sql = "select idempleado, concat(nomb, ' ', apaterno) as nombre from empleado";
        $result = mysqli_query($this->conn, $sql);
        $empleados = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $empleados[] = $row;
        }
        return $empleados;
    }


    /**obtencion de los campos de correo y telefono para validar que no existan empleados con los mismos datos */
    public function obtenerTelefono($tel)
    {
        $sql = "select telefono from empleado where telefono in('$tel'); ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }

    public function obtenerCorreo($corr)
    {
        $sql = "select correo from empleado where correo = '$corr'; ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }

    public function validarEmpleado($id, $nombre, $apaterno, $amaterno, $fecha, $direccion, $telefono, $correo, $rol)
    {
        // Escapar los valores para evitar inyección SQL
        $id = intval($id);
        $nombre = mysqli_real_escape_string($this->conn, $nombre);
        $apaterno = mysqli_real_escape_string($this->conn, $apaterno);
        $amaterno = mysqli_real_escape_string($this->conn, $amaterno);
        $fecha = mysqli_real_escape_string($this->conn, $fecha);
        $direccion = mysqli_real_escape_string($this->conn, $direccion);
        $telefono = mysqli_real_escape_string($this->conn, $telefono);
        $correo = mysqli_real_escape_string($this->conn, $correo);
        $rol = mysqli_real_escape_string($this->conn, $rol);

        // Consulta para verificar la existencia
        $query = "SELECT COUNT(*) as total 
                          FROM empleado
                          WHERE CONCAT(idempleado,'|', nomb,'|', apaterno,'|', amaterno, '|', fecnaci, '|', direccion, '|', telefono, '|',
            correo,'|', rol) 
                          = CONCAT($id,'|','$nombre', '|', '$apaterno', '|', '$amaterno', '|', '$fecha','|', 
                          '$direccion','|','$telefono','|', '$correo','|','$rol');";

        $resultado = mysqli_query($this->conn, $query);

        // Verificar si existe al menos un registro con la misma combinación
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'] > 0;
    }
}
