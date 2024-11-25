<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Transparencia
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todas las transparencias */
    public function obtenerTransparencias()
    {
        $query = "select * from transparencia";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos empleados */
    public function agregarTransparencia($nombre)
    {
        $query = "insert into transparencia (nomTransparencia) values ('$nombre');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar transparencias dependiendo el criterio del usuario */
    public function buscarTransparenciaPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nomTransparencia'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerTransparencias();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from transparencia where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un transparencias */
    public function actualizarTransparencia($id, $nombre)
    {
        $query = "update transparencia set nomTransparencia= '$nombre'  
            where idtransparencia = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarTransparencia($id)
    {
        $query = "delete from transparencia where idtransparencia =$id;";
        return mysqli_query($this->conn, $query);
    }
    public function obtenerTransparenciaID()
    {
        $query = "select idtransparencia, nomTransparencia as transparencia from transparencia";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }


    public function obtenerTransparencia($transparencia)
    {
        $sql = "select nomTransparencia from transparencia where nomTransparencia in('$transparencia'); ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }

    public function obtenerTransparenciaparaInsumos()
    {
        $sql = "select idtransparencia, nomTransparencia as transparencia from transparencia";
        $result = mysqli_query($this->conn, $sql);
        $transparencias = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $transparencias[] = $row;
        }
        return $transparencias;
    }
}
